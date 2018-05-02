<template>
	<section class="row">
		<div v-for="popular in populars" v-bind:key="popular.id" class="col-lg-2 col-md-3 col-xs-6 col-sm-4 item-card">
			<a :href="'/item/' + popular.id" :title="popular.title">
				<img :src="'storage/img/clothes/' + popular.image" :alt="popular.title">
			</a>
			<div class="item-card-price">
				<span>{{ popular.title }}</span>
				<span class="hryvnia">{{ popular.price1 }}.</span>
				<span class="change">{{ popular.price2 }} {{ hryvnia }}</span>
			</div>
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
		'hryvnia'
	],

	created() {
		this.fetchPopularItems()
	},

	methods: {
		fetchPopularItems() {
			fetch('/api/popular')
			.then(res => res.json())
			.then(res => this.populars = res.data)
			.catch(err => console.log(err))
		}
	}
}
</script>