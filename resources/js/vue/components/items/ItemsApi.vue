<template>
    <section class="main-content">
        <h3 class="display-4 text-center p-4"
            style="background:#F2F2F2;"
        >{{ headline }}</h3>
        <div class="container pb-3">
            <section class="row">
                <div v-for="(item, index) in items"
                    :key="item.id"
                    class="col-lg-2 col-md-3 col-6 col-sm-4 item-card"
                >
                    <a :href="'/item/' + item.category + '/' + item.slug"
                        :title="item.title"
                        @mouseover="changePhotoOver(index, item.photos[1] ? item.photos[1].name : '')" 
                        @mouseout="changePhotoOut(index, item.photos[0].name)"
                    >
                        <img :src="'storage/img/small/clothes/' + item.photos[0].name"
                            :alt="item.title"
                            :id="'photo' + index"
                        >
                    </a>
                    <div class="item-card-price">
                        <span>{{ item.title }}</span>
                        <span class="hryvnia">{{ item.price }} {{ hryvnia }}</span>
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
            items: {},
        }
    },
    props: ['hryvnia', 'headline', 'to'],

    created() {
        this.fetchItems()
    },

    methods: {
        fetchItems() {
            this.$axios.get(this.to)
                .then(res => this.items = res.data.data)
                .catch(err => console.error(err))
        },

        changePhotoOver(index, newSrc = null) {
            if (newSrc) {
                document.getElementById('photo' + index).src = '/storage/img/small/clothes/' + newSrc
            }
        },

        changePhotoOut(index, newSrc) {
            document.getElementById('photo' + index).src = '/storage/img/small/clothes/' + newSrc
        }
    }
}
</script>