<template>
		
		<div class="container">
			<section class="heading" style="background:#F2F2F2;">{{ title }}</section>
			<div class="row">
				<div v-for="item in items" v-bind:key="item.id" class="col-lg-2 col-md-3 col-xs-6 col-sm-4 card">
					<a :href="'/item/' + item.id" :title="item.title">
						<img :src="'/storage/img/clothes/' + item.image" :alt="item.title">
					</a>
					<div class="card-price">
						<span>{{ item.title }}</span>
						<span>{{ item.price1 }}.{{ item.price2 }} грн</span>

						<!-- Edit button -->
						<a v-if="admin == 1" :href="'/items/' + item.id + '/edit'" title="Изменить" class="btn-change-item" style="top:10px;">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</a>

						<!-- Delete button -->
						<a @click="deleteItem(item.id)" href="#" v-if="admin == 1" title="Удалить" class="btn-change-item" style="top:55px; background:brown;">
							<i class="fa fa-trash-o" aria-hidden="true" style="color:#fff;"></i>
						</a>
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

	props: [ 'admin' ],

	created() {
		this.fetchItems()
	},

	methods: {
		fetchItems(url) {
			let vm = this
			let addToUrl = '/' + location.search.split('category=')[1]

			addToUrl = (addToUrl == '/undefined') ? '' : addToUrl
			url = url || '/api/items' + addToUrl

			if (addToUrl === '/men') {
				this.title = 'Мужская одежда'
			} else if (addToUrl === '/women') {
				this.title = 'Женская одежда'
			}

			fetch(url)
				.then(res => res.json())
				.then(res => {
					this.items = res.data
					vm.makePagination(res.meta, res.links)
				})
				.catch(error => console.log(error))
		},

		makePagination(meta, links) {
			let pagination = {
				current_page: meta.current_page,
				last_page: meta.last_page,
				next_page_url: links.next,
				prev_page_url: links.prev
			}

			this.pagination = pagination
		},

		deleteItem(id) {
			if (confirm('Удалить этот товар?')) {
				fetch(`api/item/${id}`, {
					method: 'delete'
				})
				.then(res => res.json())
				.then(data => this.fetchItems())
				.catch(error => console.log(error))
			}
		}
	}
}
</script>

