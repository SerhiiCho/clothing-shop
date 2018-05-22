<template>
	<section class="row pb-2">
		<div class="col-12 col-sm-6 col-lg-5 text-center single-image">
			<img :src="'/storage/img/clothes/' + item.image" :alt="item.title">

			<!-- Edit button -->
			<a v-if="admin == 1" :href="'/items/' + item.id + '/edit'" :title="change" class="btn-change-item" style="top:10px;">
				<i class="fa fa-pencil" aria-hidden="true"></i>
			</a>

			<!-- Delete button -->
			<a v-if="admin == 1" v-on:click="deleteItem(item.id)" href="#" :title="deleting" class="btn-change-item" style="top:55px; background:brown;">
				<i class="fa fa-trash-o" aria-hidden="true" style="color:#fff;"></i>
			</a>
		</div>
		<div class="col-12 col-sm-6 col-lg-7">
			<div class="row">

				<!-- Title -->
				<div class="col-6 p-3">
					<span class="display-4">{{ item.title }}</span>
				</div>

				<!-- Price -->
				<div class="col-6 p-3">
					<p class="single-price">
						{{ item.price }}
						<span class="d-block">{{ hryvnia }}</span>
					</p>
				</div>

				<!-- ID -->
				<span class="col-12 text-secondary">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i> 
					{{ numberItem }}: {{ item.id }}
				</span>

				<!-- Add To Cart -->
				<form action="/cart/store" method="post" class="col-12 phone-form">
					<input type="hidden" name="_token" :value="token">
					<input type="hidden" name="id" :value="item.id">
					<input type="hidden" name="title" :value="item.title">
					<input type="hidden" name="price" :value="item.price">
					<button type="submit" :title="addToCart">{{ addToCart }}</button>
					<hr class="mt-3" />
				</form>

				<!-- Intro -->
				<p class="lead pr-4 pl-4">{{ item.content }}</p>
			</div>
		</div>
	</section>
</template>


<script>
export default {
	data() {
		return {
			item: [],
			clicked: false
		}
	},

	props: [
		'deleteThisProduct',
		'numberItem',
		'addToCart',
		'deleting',
		'hryvnia',
		'change',
		'token',
		'admin'
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
		},

		deleteItem(id) {
			if (confirm(this.deleteThisProduct)) {
				fetch(`/api/item/${id}`, {
					method: 'delete'
				})
				.then(res => res.json())
				.then(data => window.location.href = '/items')
				.catch(error => console.log(error))
			}
		}
	}
}
</script>
