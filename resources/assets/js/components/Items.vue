<template>
		
		<div class="container">
			<section class="heading" style="background:#F2F2F2;">{{ title }}</section>
			<div class="row">
				<div v-for="item in items" v-bind:key="item.id" class="col-lg-2 col-md-3 col-xs-6 col-sm-4 card">
					<a :href="'/item/' + item.id" :title="item.title">
						<img :src="'/storage/img/clothes/' + item.image + '.jpg'" :alt="item.title">
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
		</div>
</template>

<script>
export default {
	data() {
		return {
			items: [],
			pagination: {},
			title: 'Вся одежда'
		}
	},

	created() {
		this.fetchItems()
	},

	methods: {
		fetchItems(url) {
			let vm       = this
			let slug     = window.location.pathname.split("/").slice(-1)[0]
			let addToUrl = slug === 'men'  || slug === 'women' ? '/' + slug : ''

			if (slug === 'men') {
				this.title = 'Мужская одежда'
			} else if (slug === 'women') {
				this.title = 'Женская одежда'
			}

			url = url || '/api/items'

			fetch(url + addToUrl)
			.then(res => res.json())
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
