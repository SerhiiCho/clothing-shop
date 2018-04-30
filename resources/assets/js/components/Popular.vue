<template>
	<div>
		<div v-for="popular in populars" v-bind:key="popular.id" class="col-lg-2 col-md-3 col-xs-6 col-sm-4 card">
			<a :href="'/item/' + popular.id" :title="popular.title">
				<img :src="'storage/img/clothes/' + popular.image" :alt="popular.title">
			</a>
			<div class="card-price">
				<span>{{ popular.title }}</span>
				<span>{{ popular.price1 }}.{{ popular.price2 }} грн</span>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			populars: {}
		}
	},

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