<template>
	<section style="overflow:auto; white-space:nowrap;">
		<section v-if="orders[0] && orders[0].length !== 0">
			<table class="table table-sm text-center">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{ number }}</th>
						<th scope="col">{{ product }}</th>
						<th scope="col">{{ sum }}</th>
						<th scope="col">{{ date }}</th>
						<th scope="col"></th>
					</tr>
				</thead>
					<tbody>
						<tr v-for="order in orders[0]" :key="order.id">
							<th scope="row">{{ order.id }}</th>
							<td>{{ order.phone }}</td>
							<td>
								<a v-for="item in order.items" :key="item.id" :href="'/item/' + item.category + '/' + item.id" :title="item.title">
									#{{ item.id }}, 
								</a>
							</td>
							<td>{{ order.total }}</td>
							<td>{{ order.created_at }}</td>
							<td> 
								<!-- Delete button -->
								<a v-if="admin === 1" href="#" :title="deleteNumber + ' ' + order.phone" class="btn btn-primary" @click="deleteMessage(order.id)">
									<i class="fa fa-trash-o" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
					</tbody>
			</table>
		</section>
		<section v-else class="p-1">
			<h5 class="text-center pb-4">
				<button-back :title="noOrders"></button-back>
			</h5>
		</section>
	</section>
</template>

<script>
export default {
	data() {
		return {
			orders: []
		}
	},

	props: [
		'sum', 'date', 'number', 'admin', 'product',
		'noOrders', 'deleteNumber', 'deleteThisOrder'
	],

	created() {
		this.getMessages()
	},
	 
	methods: {
		getMessages() {
			fetch('/api/clients_orders/index')
				.then(res => res.json())
				.then(data => {
					this.orders.push(data.data)
				})
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