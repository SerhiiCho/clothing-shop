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

<style scoped>
.imgbanbtn-prev {
    background-image: url('/storage/img/arrow-left.png');
}
.imgbanbtn-next {
    background-image: url('/storage/img/arrow-right.png');
}
</style>
