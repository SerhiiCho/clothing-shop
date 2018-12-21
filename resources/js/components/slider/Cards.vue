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
                        :src="'storage/img/clothes/' + card.photos[rand(card.photos.length)].name"
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
            fetch('/api/slider/cards')
                .then(res => res.json())
                .then(res => this.cards = res.data)
                .catch(err => console.log(err))
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