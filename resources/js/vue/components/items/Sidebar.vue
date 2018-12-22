<template>
    <div class="wrapper">
        <section class="row pt-4">
            <div v-for="(item, index) in randomItems"
                :key="item.id"
                class="col-lg-2 col-md-3 col-6 col-sm-4 item-card"
            >
                <a :href="'/item/' + item.category + '/' + item.id"
                    :title="item.title"
                    @mouseover="changePhotoOver(index, item.photos[1] ? item.photos[1].name : '')"
                    @mouseout="changePhotoOut(index, item.photos[0].name)"
                >
                    <img :src="'/storage/img/clothes/' + item.photos[0].name"
                        :alt="item.title"
                        :id="'rand-photo' + index"
                    >
                </a>
                <div class="item-card-price">
                    <span>{{ item.title }}</span>
                    <span class="hryvnia">{{ item.price }} {{ hryvnia }}</span>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            randomItems: {},
            category: 'women'
        }
    },

    props: ['hryvnia', 'itemId'],

    created() {
        this.fetchItems()
    },

    methods: {
        fetchItems() {
            if (location.pathname.includes('/men/')) {
                this.category = 'men'
            }

            this.$axios.get('/api/item/random/' + this.category)
                .then(res => {
                    let data = []
                    res.data.data.map(el => {
                        if (el.id != this.itemId) {
                            data.push(el)
                        }
                    })
                    this.randomItems = data.slice(0, 6)
                })
                .catch(err => console.error(err))
        },

        changePhotoOver (index, newSrc = null) {
            if (newSrc) {
                document.getElementById('rand-photo' + index).src = '/storage/img/clothes/' + newSrc
            }
        },

        changePhotoOut (index, newSrc) {
            document.getElementById('rand-photo' + index).src = '/storage/img/clothes/' + newSrc
        }
    }
}
</script>