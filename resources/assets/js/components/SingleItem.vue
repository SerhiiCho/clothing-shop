<template>
	<section class="row">
		<div class="col-12 col-sm-4 col-lg-3 text-center single-image">
			<img :src="'/storage/img/clothes/' + item.image" :alt="item.title">
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
						{{ item.price1 }}.{{ item.price2 }}
						<span>{{ hryvnia }}</span>
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
		'admin',
		'numberitem',
		'hryvnia',
		'phonenumber',
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
							this.messageToCustomer = 'Мы с свяжимся с вами в ближайшее время'
						} else {
							this.messageToCustomer = 'Вы уже отправили ваш заказ. Вам позвонят в ближайшее время'
						}
					})
					.catch(error => console.log(error))
			} else {
				this.messageToCustomer = 'Не правильный формат номера телефона'
			}
		}
	}
}
</script>
