<template>
    <section class="row pb-2">
        <div class="modal">
            <span class="close">&times;</span>
            <img class="modal-content">
            <div id="caption"></div>
        </div>
        <div class="col-10 col-sm-9 col-lg-5 col-xl-4 text-center single-image pl-1 pr-2">
            <div v-if="imageNotLoaded">
                <section class="text-center" style="min-height:500px">
                    <div class="loader mt-5"></div>
                </section>
            </div>
            <transition name="fade" mode="out-in" appear>
                <img v-if="item.photos"
                    :src="'/storage/img/big/clothes/' + bigPhoto"
                    :alt="item.title"
                    @load="imageNotLoaded = false"
                >
            </transition>

            <!-- Edit button -->
            <a v-if="admin == 1"
                :href="'/items/' + item.id + '/edit'"
                    :title="change"
                    class="btn-change-item"
                    style="top:10px;"
                >
                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
            </a>

            <!-- Delete button -->
            <a v-if="admin == 1"
                v-on:click="deleteItem(item.id)"
                href="#"
                :title="deleting"
                class="btn-change-item"
                style="top:55px;"
            >
                <i class="fas fa-trash-alt" aria-hidden="true"></i>
            </a>
        </div>

        <!-- Cards -->
        <div class="col-1 col-sm-2 col-lg-1"
            @mouseover="imageHovered = true"
            @mouseout="imageHovered = false"
        >
            <div class="row images-to-show">
                <div v-for="(photo, index) in item.photos"
                    :key="photo.id"
                    class="col-12 mb-2 pl-0 pr-2"
                    v-if="index >= 0 && index < 5"
                >
                    <transition name="fade-slide" mode="out-in" appear>
                        <img :src="'/storage/img/small/clothes/' + photo.name"
                            @mouseover="swapPhoto(photo.name, index)"
                            :id="'photo' + index"
                            :class="'small-images ' + giveActiveClass(index)"
                        >
                    </transition>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 col-xl-7">
            <div class="row">

                <!-- Title -->
                <div class="col-6 pt-3 pb-3">
                    <span class="display-4">{{ item.title }}</span>
                </div>

                <!-- Price -->
                <div class="col-6 pt-3">
                    <p class="single-price">
                        {{ item.price }}
                        <span class="d-block">{{ hryvnia }}</span>
                    </p>
                </div>

                <!-- ID -->
                <span class="col-12 text-secondary pb-1">
                    <span class="d-block mb-2">
                        <i class="fas fa-shopping-cart" aria-hidden="true"></i> 
                        {{ codeOfTheItem }} {{ item.id }}
                    </span>
                    <span class="d-block mb-2">
                        <i class="fas fa-shopping-basket" aria-hidden="true"></i> 
                        {{ allAmount1 }} {{ item.stock }} {{ allAmount2 }}
                    </span>
                </span>

                <!-- Add To Cart -->
                <form action="/cart/store" method="post" class="col-12">
                    <input type="hidden" name="_token" :value="token">
                    <input type="hidden" name="id" :value="item.id">
                    <input type="hidden" name="title" :value="item.title">
                    <input type="hidden" name="price" :value="item.price">
                    <button type="submit" :title="addToCart" class="btn btn-outline-success">
                        {{ addToCart }}
                    </button>
                    <hr class="mt-3" />
                </form>

                <!-- Intro -->
                <p class="lead pr-4 pl-4" v-html="item.content"></p>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            item: [],
            imageHovered: false,
            imageNotLoaded: true,
            bigPhoto: 'default.jpg',
            clicked: false,
        }
    },

    props: [
        'deleteThisProduct', 'codeOfTheItem', 'addToCart', 'deleting',
        'hryvnia', 'change', 'token', 'admin', 'allAmount1', 'allAmount2'
    ],

    mounted () {
        this.fetchItem()
    },

    methods: {
        fetchItem () {
            let itemId = window.location.pathname.split("/").slice(-1)

            fetch ('/api/item/' + itemId)
                .then(res => res.json())
                .then(res => {
                    this.item = res.data
                    this.bigPhoto = res.data.photos[0].name
                })
                .catch(err => console.log(err))
        },

        deleteItem (id) {
            if (confirm(this.deleteThisProduct)) {
                this.$axios.delete('/api/item/' + id)
                    .then(data => window.location.href = '/items')
                    .catch(error => console.error(error))
            }
        },

        swapPhoto (smallPhoto, index) {
            let smallPhotoObj = document.getElementById('photo' + index)

            document.querySelectorAll('.small-images').forEach(function(item) {
                item.classList.remove("active-photo")
            })

            smallPhotoObj.classList.add("active-photo")
            this.bigPhoto = smallPhoto
        },

        giveActiveClass(i) {
            if (i == 0) {
                return 'active-photo'
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.fade {
    &-enter-active {
        transition: transform 300ms, opacity 800ms;
    }
    &-enter {
        opacity: 0;
        transform: translateY(300px);
    }
    &-enter-to {
        opacity: 1;
        transform: translateY(0);
    }
}
.fade-slide {
    &-enter-active {
        transition: transform 400ms, opacity 800ms;
    }
    &-enter {
        opacity: 0;
        transform: translateX(-100px);
    }
    &-enter-to {
        opacity: 1;
        transform: translateX(0);
    }
}
</style>
