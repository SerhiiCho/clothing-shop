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

				<!-- ID -->
				<div class="col-xs-12">
					<span class="single-status">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i> 
						{{ numberitem }}: {{ item.id }}
					</span>
				</div>

				<!-- Callback -->
				<p>{{ error }}</p>
				<div class="col-xs-12">
					+38 <input v-model="phoneNumber" type="text" placeholder="Номер телефона" maxlength="10">
					<button @click="sentPhoneNumber()">Заказать</button>
				</div>

				<!-- Intro -->
				<div class="col-xs-12 single-intro">
					<p>{{ item.content }}</p>
				</div>
			</div>
		</div>
	</section>
</template>


<script>
export default {
	data() {
		return {
			item: [],
			error: '',
			phoneNumber: ''
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
		},

		validatePhoneNumber(input) {
			var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
			this.error = ''

			if (input.match(phoneno)) {
				this.error = 'Мы с свяжимся с вами в ближайшее время'
			} else {
				this.error = 'Не правильный формат номера телефона'
			}
		},

		sentPhoneNumber() {
			this.validatePhoneNumber(this.phoneNumber)
			//if(!this.name) this.errors.push("Name required.");
		}
	}
}
</script>
