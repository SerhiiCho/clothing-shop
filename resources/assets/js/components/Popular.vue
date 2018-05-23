<template>
	<section class="main-content">
		<h3 class="display-4 text-center p-4" style="background:#F2F2F2;">{{ popular }}</h3>
		<div class="container pb-3">
			<section class="row">
				<div v-for="popular in populars" v-bind:key="popular.id" class="col-lg-2 col-md-3 col-6 col-sm-4 item-card">
					<a :href="'/item/' + popular.category + '/' + popular.id" :title="popular.title">
						<img :src="'storage/img/clothes/' + popular.image" :alt="popular.title">
					</a>
					<div class="item-card-price">
						<span>{{ popular.title }}</span>
						<span class="hryvnia">{{ popular.price }} {{ hryvnia }}</span>
					</div>
				</div>
			</section>
		</div>
	</section>
</template>

<script>
export default {
	data() {
		return {
			populars: {}
		}
	},

	props: [
		'hryvnia',
		'popular'
	],

	created() {
		this.fetchPopularItems()
	},

	methods: {
		fetchPopularItems() {
			fetch('/api/item/popular')
			.then(res => res.json())
			.then(res => this.populars = res.data)
			.catch(err => console.log(err))
		}
	}
}
</script>