<template>
	<div class="wrapper">
		<section class="row pt-4">
			<div v-for="item in items" v-bind:key="item.id" class="col-lg-2 col-md-3 col-6 col-sm-4 item-card">
				<a :href="'/item/' + item.id" :title="item.title">
					<img :src="'/storage/img/clothes/' + item.image" :alt="item.title">
				</a>
				<div class="item-card-price">
					<span>{{ item.title }}</span>
					<span class="hryvnia">{{ item.price }} {{ hryvnia }}</span>
				</div>
			</div>
		</section>
	</div>
</template>

<script>
export default {
	data() {
		return {
			items: {}
		}
	},

	props: [
		'hryvnia',
		'itemid'
	],

	created() {
		this.fetchItems()
	},

	methods: {
		fetchItems() {
			fetch('/api/item/random')
				.then(res => res.json())
				.then(res => {
					let removeIdenticalItem = res.data.map(el => el.id).indexOf(this.itemid)
					res.data.splice(removeIdenticalItem, 1)
					this.items = res.data
				})
				.catch(err => console.log(err))
		}
	}
}
</script>