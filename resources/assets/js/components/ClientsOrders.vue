<template>
	<section>
		<section v-if="orders[0] && orders[0].length !== 0">
			<table class="table table-sm">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Номер</th>
						<th scope="col">Товар#</th>
						<th scope="col">Время</th>
						<th scope="col">Удалить</th>
					</tr>
				</thead>
					<tbody>
						<tr v-for="order in orders[0]" v-bind:key="order.id">
							<th scope="row">{{ order.id }}</th>
							<td>{{ order.phone }}</td>
							<td>
								{{ order.item_id }} 
								<a :href="'/item/' + order.item_id">
									<i class="fa fa-external-link" aria-hidden="true"></i>
								</a>
							</td>
							<td>{{ order.created_at }}</td>
							<td> 
								<a href="#" :title="'Удалить номер ' + order.phone" class="btn btn-danger" @click="deleteMessage(order.id)">
									<i class="fa fa-trash-o" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
					</tbody>
			</table>
		</section>
		<section v-else class="p-1">
			<h5 class="text-center pb-4">
				<i class="fa fa-frown-o" aria-hidden="true"></i> 
				Нет заказов
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

	created() {
		this.getMessages()
	},
	 
	methods: {
		getMessages() {
			fetch('/api/clients_orders/index')
				.then(res => res.json())
				.then(data => {
					this.orders.push(data)
				})
				.catch(err => console.log(err))
		},

		deleteMessage(id) {
			if (confirm('Удалить этот заказ?')) {
				fetch(`/api/clients_orders/destroy/${id}`, {
					method: 'delete'
				})
					.then(res => res.json())
					.then(data => {
						this.orders = []
						this.orders.push(data)
						this.getMessages()
					})
					.catch(error => console.log(error))
			}
		}
	}
}
</script>