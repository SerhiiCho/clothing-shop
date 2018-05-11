<template>
	<section class="row pb-2">
		<div class="col-12 col-sm-4 col-lg-3 text-center single-image">
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
		<div class="col-12 col-sm-8 col-lg-9">
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
					{{ numberitem }}: {{ item.id }}
				</span>

				<!-- Callback -->
				<div class="col-12 phone-form">
					+38 
					<input v-model="phoneNumber" @keyup.enter="sentPhoneNumber(item.id)" type="text" :placeholder="phonenumber" maxlength="10">
					<button @click="sentPhoneNumber(item.id)" :title="order">{{ order }}</button>
					<div v-if="clicked" class="alert alert-pink mt-3" role="alert">{{ messageToCustomer }}</div>

					<hr class="mt-3" />
				</div>

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
			messageToCustomer: '',
			phoneNumber: '',
			clicked: false
		}
	},

	props: [
		'deletethisphonenuber',
		'phonenumberincorrect',
		'youalreadysendorder',
		'wewillcontactyou',
		'phonenumber',
		'numberitem',
		'deleting',
		'hryvnia',
		'change',
		'admin',
		'order'
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

		validatePhoneNumber(input) {
			var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

			if (input.match(phoneno)) {
				return true;
			}
			return;
		},

		sentPhoneNumber(item) {
			this.clicked = true
			if (this.validatePhoneNumber(this.phoneNumber)) {
				let dataForRequest = {
					item: item,
					phone: this.phoneNumber
				}

				fetch('/api/clients_orders/store', {
						method: 'post',
						body: JSON.stringify(dataForRequest),
						headers: {
							'content-type': 'application/json'
						}
					})
					.then(res => res.text())
					.then(data => {
						if (data === 'success') {
							this.messageToCustomer = this.wewillcontactyou
						} else {
							this.messageToCustomer = this.youalreadysendorder
						}
					})
					.catch(error => console.log(error))
			} else {
				this.messageToCustomer = this.phonenumberincorrect
			}
		},

		deleteItem(id) {
			if (confirm(this.deletethisphonenuber)) {
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
