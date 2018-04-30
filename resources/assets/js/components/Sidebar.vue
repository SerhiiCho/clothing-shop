<template>
	<div>
		<div v-for="item in items" v-bind:key="item.id" class="col-lg-2 col-md-3 col-xs-6 col-sm-4 card">
			<a :href="'/item/' + item.id" :title="item.title">
				<img :src="'/storage/img/clothes/' + item.image" :alt="item.title">
			</a>
			<div class="card-price">
				<span>{{ item.title }}</span>
				<span>{{ item.price1 }}.{{ item.price2 }} грн</span>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			items: {}
		}
	},

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