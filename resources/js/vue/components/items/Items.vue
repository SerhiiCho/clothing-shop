<template>
    <div class="row">
        <div v-if="items"
            v-for="(item, index) in items"
            :key="item.id"
            class="col-lg-3 col-6 item-card"
        >
            <a :href="'/item/' + item.category + '/' + item.id"
                :title="item.title"
                v-if="item.photos.length > 0"
                @mouseover="changePhotoOver(index, item.photos[1] ? item.photos[1].name : '')"
                @mouseout="changePhotoOut(index, item.photos[0].name)"
            >
                <img  :src="'/storage/img/clothes/' + item.photos[0].name"
                    :alt="item.title"
                    :id="'photo' + index"
                >
            </a>
            <div class="item-card-price">
                <span>{{ item.title }}</span>
                <span class="hryvnia">{{ item.price }} {{ hryvnia }}</span>

                <!-- Edit button -->
                <a v-if="admin == 1"
                    :href="'/items/' + item.id + '/edit'"
                    :title="change"
                    class="btn-change-item"
                    style="top:10px;"
                >
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>

                <!-- Delete button -->
                <a v-if="admin == 1" href="#"
                    v-on:click="deleteItem(item.id)"
                    :title="deleting"
                    class="btn-change-item"
                    style="top:55px;"
                >
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <!-- Pagination -->
        <nav class="col-12">
            <ul class="pagination"
                v-if="pagination.next_page_url || pagination.prev_page_url"
            >
                <li v-if="pagination.prev_page_url" class="page-item">
                    <a @click="fetchItems(pagination.prev_page_url)"
                        class="page-link"
                        href="#"
                    >&laquo;</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">
                        {{ pagination.current_page }} / {{ pagination.last_page }}
                    </a>
                </li>
                <li v-if="pagination.next_page_url" class="page-item">
                    <a @click="fetchItems(pagination.next_page_url)"
                        class="page-link"
                        href="#"
                    >&raquo;</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [],
            pagination: {},
            title: this.allItems
        }
    },

    props: ['category', 'allItems', 'deleting', 'hryvnia', 'change', 'admin'],

    created() {
        this.fetchItems()
    },

    methods: {
        fetchItems(url) {
            let vm = this
            let category = '/' + location.search.split('category=')[1]
            let type = '/' + location.search.split('type=')[1]
            let wholeUrl = category.replace("&type=", "/")
            let addToUrl = wholeUrl

            if (addToUrl == '/undefined') {
                addToUrl = ''
            }

            url = url || '/api/items' + addToUrl

            this.$axios.get(url)
                .then(res => {
                    this.items = res.data.data
                    vm.makePagination(res.data.meta, res.data.links)
                })
                .catch(error => console.error(error))
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

        deleteItem(id) {
            if (confirm('Удалить этот товар?')) {
                this.$axios.delete('api/item/' + id)
                    .then(res => this.fetchItems())
                    .catch(error => console.error(error))
            }
        },

        changePhotoOver (index, newSrc = null) {
            if (newSrc) {
                document.getElementById('photo' + index).src = '/storage/img/clothes/' + newSrc
            }
        },

        changePhotoOut (index, newSrc) {
            document.getElementById('photo' + index).src = '/storage/img/clothes/' + newSrc
        }

    }
}
</script>

