<template>
	<div>
		<div class="row pb-5" v-if="orders[0] && orders[0].length !== 0">
			<div class="col-sm-6 col-xl-4" v-for="order in orders[0]" :key="order.id">
				<div class="card">
					<a v-if="admin === 1" href="#" :title="deleteNumber + ' ' + order.phone" class="btn btn-success btn-sm" @click="deleteMessage(order.id)">
						<i class="fa fa-trash-o" aria-hidden="true"></i>
					</a>
					<div class="card-body">
						<h5 class="card-title">{{ clientsOrder }} # {{ order.id }}</h5>
						<hr />
						<p class="card-text mb-1">
							{{ number }}: <strong>{{ order.phone }}</strong>
						</p>
						<p class="card-text mb-1">
							{{ sum }}: <strong>{{ order.total }} {{ hryvnia }}</strong>
						</p>
						<p class="card-text mb-1">
							{{ date }}: <strong>{{ order.created_at }}</strong>
						</p>
						<hr />

						{{ product }}:
						<a v-for="item in order.items" :key="item.id" :href="'/item/' + item.category + '/' + item.id" :title="item.title" class="btn btn-primary ml-2 p-1">#{{ item.id }}</a>
					</div>
				</div>
			</div>
		</div>
		<section v-else class="p-1">
			<h5 class="text-center pb-4">
				<button-back :title="noOrders"></button-back>
			</h5>
		</section>
	</div>
</template>

<script>
export default {
	data() {
		return {
			orders: []
		}
	},

	props: [
		'sum', 'date', 'number', 'admin', 'product', 'clientsOrder',
		'noOrders', 'deleteNumber', 'deleteThisOrder', 'hryvnia'
	],

	created() {
		this.getMessages()
	},
	 
	methods: {
		getMessages() {
			fetch('/api/clients_orders/index')
				.then(res => res.json())
				.then(data => this.orders.push(data.data))
				.catch(err => console.log(err))
		},

		deleteMessage(id) {
			if (confirm(this.deleteThisOrder)) {
				fetch(`/api/clients_orders/destroy/${id}`, {
					method: 'delete'
				})
					.then(res => res.json())
					.then(data => {
						this.orders = []
						this.orders.push(data.data)
						this.getMessages()
					})
					.catch(error => console.log(error))
			}
		}
	}
}
</script>