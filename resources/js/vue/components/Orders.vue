<template>
    <div>
        <tabs>
            <tab v-for="tab in tabs"
                :key="tab.hash" 
                :name="tab.title" 
                :hash="tab.hash"
                :selected="tab.hash == '#!tab-1'"
            >
                <div class="col-12" v-if="!loading && orders.length <= 0">
                    <h5 class="pt-4 pb-3 text-center">
                        {{ noOrders }}
                    </h5>
                </div>
                <div class="row pb-5">
                    <order v-for="(order, i) in orders"
                        :key="i"
                        :color="tab.color"
                        :order="order"
                        :slug="tab.slug"
                        :take-order="takeOrder"
                        :delete-order="deleteOrder"
                        :delete-this-order="deleteThisOrder"
                        :close-this-order="closeThisOrder"
                        :taken-by="takenBy"
                        :client-order="clientOrder"
                        :number="number"
                        :sum="sum"
                        :date="date"
                        :products="products"
                        :hryvnia="hryvnia"
                        :close-order="closeOrder"
                        :user-id="userId"
                        :untake-order="untakeOrder"
                    ></order>
                </div>
            </tab>

            <!-- Preloader -->
            <div class="col-12 text-center pt-2 pb-5" v-if="loading">
                <div class="loader mx-auto"></div>
            </div>
        </tabs>
    </div>
</template>

<script>
import Order from "./Order";
import Tabs from "./Tabs";
import Tab from "./Tab";

export default {
    data() {
        return {
            loading: false,
            theEnd: false,
            url: null,
            currentSlug: 'opened',
            orders: [],
            tabs: [
                {
                    title: this.openedOrders,
                    hash: '#!tab-1',
                    color: 'green',
                    slug: 'opened',
                },
                {
                    title: this.takenOrders,
                    hash: '#!tab-2',
                    color: '#8788e0',
                    slug: 'taken',
                },
                {
                    title: this.closedOrders,
                    hash: '#!tab-3',
                    color: '#e56114',
                    slug: 'closed',
                },
            ],
        }
    },

    props: [
        'openedOrders',
        'takenOrders',
        'closedOrders',
        'takeOrder',
        'untakeOrder',
        'closeOrder',
        'deleteThisOrder',
        'closeThisOrder',
        'clientOrder',
        'number',
        'deleteOrder',
        'noOrders',
        'takenBy',
        'sum',
        'date',
        'hryvnia',
        'products',
        'userId',
    ],

    created() {
        let hash = window.location.hash.substring(0);
        if (hash) {
            this.currentSlug = this.tabs.filter(tab => tab.hash == hash)[0].slug;
        }
        this.fetchOrders(true);

        window.addEventListener('scroll', () => {
            if (!this.theEnd) {
                this.onScroll()
            }
        })

        Event.$on('tab-changed', hash => {
            this.orders = []
            this.loading = true
            this.url = null
            this.currentSlug = this.tabs.filter(tab => tab.hash == hash)[0].slug;
            this.fetchOrders(true);
        });
    },

    methods: {
        fetchOrders(reload = false) {
            this.loading = true
            let url = this.url === null ? '/api/orders/' + this.currentSlug : this.url

            this.$axios.post(url)
                .then(res => {
                    if (res.data.links.next !== null) {
                        this.url = res.data.links.next
                    } else {
                        this.theEnd = true
                    }

                    this.orders = reload ? res.data.data : this.orders.concat(res.data.data)
                    this.loading = false
                })
                .catch(err => {
                    console.error(err)
                    this.loading = false
                })
        },

        onScroll() {
            let wrap = document.getElementById('orders-page')
            let contentHeight = wrap.offsetHeight
            let yOffset = window.pageYOffset
            let currentPosition = yOffset + window.innerHeight

            if (currentPosition >= contentHeight && !this.theEnd) {
                this.fetchOrders()
            }
        },
    },
    components: {
        Tabs, Tab, Order,
    },
}
</script>