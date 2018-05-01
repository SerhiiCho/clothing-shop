<template>
	<section>
		<div class="col-xs-12 col-sm-4 col-lg-3 single-image">
			<img :src="'/storage/img/clothes/' + item.image" :alt="item.title">
		</div>
		<div class="col-xs-12 col-sm-8 col-lg-9 single-info">
			<div class="row">

				<!-- Title -->
				<div class="col-xs-6">
					<span class="single-title">{{ item.title }}</span>
				</div>

				<!-- Price -->
				<div class="col-xs-6">
					<p class="single-price">
						{{ item.price1 }}.{{ item.price2 }}
						<span>{{ hryvnia }}</span>
					</p>
				</div>

				<!-- ID and Category -->
				<div class="col-xs-12">
					<span class="single-status">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i> 
						{{ numberitem }}: {{ item.id }}
					</span>
				</div>

				<!-- Intro -->
				<div class="col-xs-12 single-intro">
					<p><!-- Intro here--></p>
				</div>
			</div>
		</div>
	</section>
</template>


<script>
export default {
	data() {
		return {
			item: []
		}
	},

	props: [
		'admin',
		'numberitem',
		'hryvnia'
	],

	created() {
		this.fetchItem()
	},

	methods: {
		fetchItem() {
			let itemId = window.location.pathname.split("/").slice(-1)

			fetch('/api/item/' + itemId)
			.then(res => res.json())
			.then(res => this.item = res.data)
			.catch(err => console.log(err))
		}
	}
}
</script>
