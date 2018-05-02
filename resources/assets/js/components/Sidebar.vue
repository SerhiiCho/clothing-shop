<template>
	<section class="row">
		<div v-for="item in items" v-bind:key="item.id" class="col-lg-2 col-md-3 col-6 col-sm-4 item-card">
			<a :href="'/item/' + item.id" :title="item.title">
				<img :src="'/storage/img/clothes/' + item.image" :alt="item.title">
			</a>
			<div class="item-card-price">
				<span>{{ item.title }}</span>
				<span class="hryvnia">{{ item.price1 }}.</span>
				<span class="change">{{ item.price2 }} {{ hryvnia }}</span>
			</div>
		</div>
	</section>
</template>

<script>
export default {
	data() {
		return {
			items: {}
		}
	},

	props: [
		'hryvnia'
	],

	created() {
		this.fetchItems()
	},

	methods: {
		fetchItems() {
			fetch('/api/random')
			.then(res => res.json())
			.then(res =>  this.items = res.data)
			.catch(err => console.log(err))
		}
	}
}
</script>