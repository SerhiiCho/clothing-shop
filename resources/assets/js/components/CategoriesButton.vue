<template>
	<div class="text-center">
		<button @click="openSidebar()" class="category-btn btn btn-lg btn-light mb-4">
			{{ categories }} &raquo;
		</button>
	</div>
</template>

<script>
export default {
	data() {
		return {
			opened: false
		}
	},

	props: [
		'categories'
	],

	created() {
		this.closeSidebar()
	},
	 
	methods: {
		openSidebar () {
			if (this.opened === false) {
				document.querySelector('.items-sidebar').style.left = '5px'
				this.opened = true
			}
		},

		closeSidebar() {
			window.addEventListener('mouseup', e => {
				if (this.opened === true) {
					document.querySelector('.items-sidebar').style.left = '-270px'
					this.opened = false
				}
			})
		}
	}
}
</script>