<template>
    <transition name="fade" mode="out-in" appear>
        <div class="col-10 pr-0 main-slider"
            v-if="images.length > 0"
            :style="sliderBg" 
            v-on:mouseover="stopRotation"
            v-on:mouseout="startRotation"
        >
            <div v-on:click="prev" class="imgbanbtn imgbanbtn-prev"></div>
            <div v-on:click="next" class="imgbanbtn imgbanbtn-next"></div>
        </div>
        <div v-if="images.length < 1" class="col-10 pr-0 main-slider text-center"></div>
    </transition>
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

    mounted() {
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
            this.$axios.get('/api/slider/main')
                .then(res => {
                    for (let i = 0; i < res.data.length; i++) {
                        this.images.push(res.data[i].image)
                    }
                })
                .catch(err => console.error(err))
        },
    },

    computed: {
        sliderBg() {
            return 'background-image:url(storage/img/slider/' +
                this.images[Math.abs(this.currentNumber) % this.images.length] +
            ')';
        },
    },
}
</script>

<style lang="scss" scoped>
.imgbanbtn {
    &-prev {
        background-image: url('/storage/img/arrow-left.png');
    }
    &-next {
        background-image: url('/storage/img/arrow-right.png');
    }
}
.fade {
    &-enter-active {
        transition: opacity 400ms;
    }
    &-enter {
        opacity: 0;
    }
    &-enter-to {
        opacity: 1;
    }
}
</style>
