<template>
    <section class="main-content">
        <h3 class="display-4 text-center p-4"
            style="background:#F2F2F2;"
        >{{ popular }}</h3>
        <div class="container pb-3">
            <section class="row">
                <div v-for="(popular, index) in populars"
                    :key="popular.slug"
                    class="col-lg-2 col-md-3 col-6 col-sm-4 item-card"
                >
                    <a :href="'/item/' + popular.category + '/' + popular.slug"
                        :title="popular.title"
                        @mouseover="changePhotoOver(index, popular.photos[1] ? popular.photos[1].name : '')" 
                        @mouseout="changePhotoOut(index, popular.photos[0].name)"
                    >
                        <img :src="'storage/img/small/clothes/' + popular.photos[0].name"
                            :alt="popular.title"
                            :id="'photo' + index"
                        >
                    </a>
                    <div class="item-card-price">
                        <span>{{ popular.title }}</span>
                        <span class="hryvnia">{{ popular.price }} {{ hryvnia }}</span>
                    </div>
                </div>
            </section>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            populars: {}
        }
    },
    props: [ 'hryvnia', 'popular' ],

    created() {
        this.fetchPopularItems()
    },

    methods: {
        fetchPopularItems() {
            this.$axios.get('/api/item/popular')
                .then(res => this.populars = res.data.data)
                .catch(err => console.error(err))
        },

        changePhotoOver (index, newSrc = null) {
            if (newSrc) {
                document.getElementById('photo' + index).src = '/storage/img/small/clothes/' + newSrc
            }
        },

        changePhotoOut (index, newSrc) {
            document.getElementById('photo' + index).src = '/storage/img/small/clothes/' + newSrc
        }
    }
}
</script>