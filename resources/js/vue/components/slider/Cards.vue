<template>
    <div class="col-2 pr-0 pl-0">
        <div class="slider-items"
            @mouseover="stopUpdating()"
            @mouseout="startUpdating()"
        >
            <div v-if="cards.length == 2"
                v-for="card in cards"
                :key="card.id"
                class="slider-items-card"
            >
                <a :href="'/item/' + card.category + '/' + card.id"
                    :title="card.title"
                >
                    <img v-if="card.photos"
                        :src="'storage/img/small/clothes/' + card.photos[rand(card.photos.length)].name"
                    >
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cards: [],
            cardTimer: null,
        }
    },

    created () {
        this.getCards(),
        this.startUpdating()
    },
    
    methods: {
        getCards() {
            this.$axios.get('/api/slider/cards')
                .then(res => this.cards = res.data.data)
                .catch(err => console.error(err))
        },

        startUpdating() {
            this.cardTimer = setInterval(() => this.getCards(), 5000)
        },
        startRotation: function() {
            this.timer = setInterval(this.next, 5000)
        },

        stopUpdating() {
            clearTimeout(this.cardTimer)
            this.cardTimer = null
        },

        rand(max) {
            return Math.floor(Math.random() * Math.floor(max))
        }
    }
}
</script>