<template>
    <div class="row">
        <div v-if="items"
            v-for="(item, index) in items"
            :key="item.id"
            class="col-lg-3 col-6 item-card"
        >
            <transition name="fade" mode="out-in" appear>
                <a :href="'/item/' + item.category + '/' + item.slug"
                    :title="item.title"
                    v-if="item.photos.length > 0"
                    @mouseover="changePhotoOver(index, item.photos[1] ? item.photos[1].name : '')"
                    @mouseout="changePhotoOut(index, item.photos[0].name)"
                >
                    <img :src="'/storage/img/small/clothes/' + item.photos[0].name"
                        :alt="item.title"
                        :id="'photo' + index"
                    >
                </a>
            </transition>
            <div class="item-card-price">
                <span>{{ item.title }}</span>
                <span class="hryvnia">{{ item.price }} {{ hryvnia }}</span>

                <!-- Edit button -->
                <a v-if="admin == 1"
                    :href="'/items/' + item.slug + '/edit'"
                    :title="change"
                    class="btn-change-item"
                    style="top:10px;"
                >
                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                </a>

                <!-- Delete button -->
                <a v-if="admin == 1" href="#"
                    v-on:click="deleteItem(item.slug)"
                    :title="deleting"
                    class="btn-change-item"
                    style="top:55px;"
                >
                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <!-- Preloader -->
        <div class="col-12 text-center py-5" v-if="loading">
            <div class="loader mx-auto"></div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            title: this.allItems,
            items: [],
            loading: false,
            url: null,
            theEnd: false,
        }
    },

    props: ['category', 'allItems', 'deleting', 'hryvnia', 'change', 'admin'],

    created() {
        this.fetchItems(true)

        window.addEventListener('scroll', () => {
            if (!this.theEnd) {
                this.onScroll()
            }
        })
    },

    methods: {
        fetchItems(reload = false) {
            this.loading = true

            let vm = this
            let category = '/' + location.search.split('category=')[1]
            let type = '/' + location.search.split('type=')[1]
            let wholeUrl = category.replace("&type=", "/")
            let addToUrl = wholeUrl

            if (addToUrl == '/undefined') {
                addToUrl = ''
            }

            let url = this.url === null ? '/api/items' + addToUrl : this.url

            this.$axios.get(url)
                .then(res => {
                    if (res.data.links.next !== null) {
                        this.url = res.data.links.next
                    } else {
                        this.theEnd = true
                    }
                    this.items = reload ? res.data.data : this.items.concat(res.data.data)
                    this.loading = false
                })
                .catch(error => {
                    console.error(error)
                    this.loading = false
                })
        },

        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            }

            this.pagination = pagination
        },

        deleteItem(slug) {
            if (confirm('Удалить этот товар?')) {
                this.$axios.delete('api/item/' + slug)
                    .then(res => this.fetchItems())
                    .catch(error => console.error(error))
            }
        },

        changePhotoOver (index, newSrc = null) {
            if (newSrc) {
                document.getElementById('photo' + index).src = '/storage/img/small/clothes/' + newSrc
            }
        },

        onScroll() {
            let wrap = document.getElementById('items-page')
            let contentHeight = wrap.offsetHeight
            let yOffset = window.pageYOffset
            let currentPosition = yOffset + window.innerHeight

            if (currentPosition >= contentHeight && !this.loading) {
                this.fetchItems()
            }
        },

        changePhotoOut (index, newSrc) {
            document.getElementById('photo' + index).src = '/storage/img/small/clothes/' + newSrc
        }

    }
}
</script>

<style lang="scss" scoped>
.fade {
    &-enter-active {
        transition: opacity 800ms;
    }
    &-enter {
        opacity: 0;
    }
    &-enter-to {
        opacity: 1;
    }
}
</style>
