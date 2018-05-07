<template>
    <div class="main-banner">
		<div @click="prev" class="imgbanbtn imgbanbtn-prev" style="background-image: url(storage/img/arrow-left.png);"></div>

			<div>
				<img
					:src="images[Math.abs(currentNumber) % images.length]"
					v-on:mouseover="stopRotation"
					v-on:mouseout="startRotation"
					alt="banner"
				/>
			</div>

		<div @click="next" class="imgbanbtn imgbanbtn-next" style="background-image: url(storage/img/arrow-right.png);"></div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			images: [
				'storage/img/banner/1.jpg',
				'storage/img/banner/2.jpg',
				'storage/img/banner/3.jpg'
			],
			currentNumber: 0
		}
	},

	created() {
		this.startRotation()
	},

	methods: {
		startRotation: function() {
            this.timer = setInterval(this.next, 5000);
        },

        stopRotation: function() {
            clearTimeout(this.timer);
            this.timer = null;
        },

        next: function() {
            this.currentNumber += 1
		},
		
        prev: function() {
            this.currentNumber -= 1
        }
	}
}
</script>


