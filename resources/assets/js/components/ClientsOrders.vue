<template>
	<section>
		<section v-if="orders[0].length > 0">
			<table class="table table-sm">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Номер</th>
						<th scope="col">Товар</th>
						<th scope="col">Время</th>
						<th scope="col">Удалить</th>
					</tr>
				</thead>
					<tbody>
						<tr v-for="order in orders[0]" v-bind:key="order.id">
							<th scope="row">{{ order.id }}</th>
							<td>{{ order.phone }}</td>
							<td>
								{{ order.item_id }} - 
								<a :href="'/item/' + order.item_id">
									<i class="fa fa-external-link" aria-hidden="true"></i>
								</a>
							</td>
							<td>{{ order.created_at }}</td>
							<td> 
								<a href="#" class="text-danger">
									<i class="fa fa-trash-o" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
					</tbody>
			</table>
		</section>
		<section v-else class="p-5">
			<h4 class="text-center">Нет заказов</h4>
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
		}
	}
}
</script>