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
						<tr v-for="order in orders[0]" v-bind:key="order.id">
							<th scope="row">{{ order.id }}</th>
							<td>{{ order.phone }}</td>
							<td>
								<a v-for="item in convertToArray(order.order)" v-bind:key="item" :href="'/item/' + item">
									<span class="badge badge-dark d-block mt-1 mb-1 p-2">
										# {{ item }}
									</span>
								</a>
							</td>
							<td>{{ order.total }}</td>
							<td>{{ order.created_at }}</td>
							<td> 
								<!-- Delete button -->
								<a v-if="admin === 1" href="#" :title="deletenumber + ' ' + order.phone" class="btn btn-danger" @click="deleteMessage(order.id)">
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
				{{ noorders }}
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
		'sum',
		'date',
		'number',
		'admin',
		'product',
		'noorders',
		'deletenumber',
		'deletethisorder'
	],

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
			if (confirm(this.deletethisorder)) {
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
		},

		convertToArray(item) {
			return item
					.split(' || ')
					.splice(1, item.length);
		}
	}
}
</script>