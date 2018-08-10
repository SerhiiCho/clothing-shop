<template>
	<li :class="currentClass()" role="alert" v-if="visible">
		<slot></slot>
		<button type="button" class="close" @click="visible = false">
			<span aria-hidden="true">&times;</span>
		</button>
	</li>
</template>

<script>
export default {
	data() {
		return {
			visible: true,
			successMessage: 'alert alert-success alert-dismissible fade show',
			errorMessage: 'alert alert-danger alert-dismissible fade show'
		}
	},
	props: ['state'],

	methods: {
		currentClass() {
			return this.state == 'success'
				? this.successMessage
				: this.errorMessage
		}
	}
}
</script>