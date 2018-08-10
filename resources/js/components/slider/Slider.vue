<template>
    <div class="col-10 pr-0 main-slider" v-if="images.length > 0" :style="'background-image:url(storage/img/slider/' + images[Math.abs(currentNumber) % images.length] + ');'" v-on:mouseover="stopRotation" v-on:mouseout="startRotation">

		<div @click="prev" class="imgbanbtn imgbanbtn-prev" style="background-image:url(storage/img/arrow-left.png);"></div>

		<div @click="next" class="imgbanbtn imgbanbtn-next" style="background-image:url(storage/img/arrow-right.png);"></div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			images: [],
			order: [],
			timer: null,
			currentNumber: 0
		}
	},

	created() {
		this.startRotation(),
		this.fetchSlides()
	},

	methods: {
		startRotation: function() {
            this.timer = setInterval(this.next, 5000)
        },

        stopRotation: function() {
            clearTimeout(this.timer)
            this.timer = null
        },

        next: function() {
            this.currentNumber += 1
		},
		
        prev: function() {
            this.currentNumber -= 1
		},
		
		fetchSlides() {
			fetch('/api/slider/main')
				.then(res => res.json())
				.then(data => {
					for (let i = 0; i < data.length; i++) {
						this.images.push(data[i].image)
					}
				})
				.catch(err => console.log(err))
		}
	}
}
</script>