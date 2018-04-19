<template>
	<div>
		<div v-for="item in items" v-bind:key="item" class="col-lg-2 col-md-3 col-xs-6 col-sm-4 card">
			<a :href="'items/' + item.id" :title="item.title">
				<img :src="'storage/img/clothes/' + item.image + '.jpg'" :alt="item.title">
			</a>
			<div class="card-price">
				<span>{{ item.title }}</span>
				<span>{{ item.price }} грн</span>
			</div>
		</div>

		<!-- Pagination -->
		<div v-if="pagination.next_page_url || pagination.prev_page_url" class="pagination">
			<li v-if="pagination.prev_page_url">
				<a @click="fetchItems(pagination.prev_page_url)" href="#">&laquo;</a>
			</li>
			<li class="disabled">
				<a class="page-link">{{ pagination.current_page }} / {{ pagination.last_page }}</a>
			</li>
			<li v-if="pagination.next_page_url">
				<a @click="fetchItems(pagination.next_page_url) " href="#">&raquo;</a>
			</li>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			items: [],
			pagination: {}
		}
	},

	created() {
		this.fetchItems()
	},

	methods: {
		fetchItems(url) {
			let vm = this;
			url = url || 'api/items'

			fetch(url)
			.then(res => res.json(res))
			.then(res => {
				this.items = res.data
				vm.makePagination(res.meta, res.links)
			})
			.catch(error => console.log(error))
		},

		makePagination(meta, links) {
			let pagintaion = {
				current_page: meta.current_page,
				last_page: meta.last_page,
				next_page_url: links.next,
				prev_page_url: links.prev
			}

			this.pagination = pagintaion
		}
	}
}
</script>
