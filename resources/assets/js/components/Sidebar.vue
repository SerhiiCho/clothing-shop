<template>
	<div class="wrapper">
		<section class="row pt-4">
			<div v-for="(item, index) in items" v-bind:key="item.id" class="col-lg-2 col-md-3 col-6 col-sm-4 item-card">
				<a :href="'/item/' + item.category + '/' + item.id" :title="item.title" @mouseover="changePhotoOver(index, item.photos[1] ? item.photos[1].name : '')" @mouseout="changePhotoOut(index, item.photos[0].name)">
					<img :src="'/storage/img/clothes/' + item.photos[0].name" :alt="item.title" :id="'photo' + index">
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
			items: {},
			category: 'women'
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
			if (location.pathname.includes('/men/')) {
				this.category = 'men'
			}

			fetch('/api/item/random/' + this.category)
				.then(res => res.json())
				.then(res => {
					let removeIdenticalItem = res.data.map(el => el.id).indexOf(this.itemid)
					res.data.splice(removeIdenticalItem, 1)
					this.items = res.data
				})
				.catch(err => console.log(err))
		},

		changePhotoOver (index, newSrc = null) {
			if (newSrc) {
				document.getElementById('photo' + index).src = '/storage/img/clothes/' + newSrc
			}
		},

		changePhotoOut (index, newSrc) {
			document.getElementById('photo' + index).src = '/storage/img/clothes/' + newSrc
		}
	}
}
</script>