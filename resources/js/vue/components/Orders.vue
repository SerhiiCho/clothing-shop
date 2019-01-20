<script>
import Order from "./Order";
import Tabs from "./Tabs";
import Tab from "./Tab";

export default {
    data() {
        return {
            loading: false,
            theEnd: false,
            countedOrders: ['-', '-', '-'],
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
    ],

    created() {
        let hash = window.location.hash.substring(0);
        if (hash) {
            this.currentSlug = this.tabs.filter(tab => tab.hash == hash)[0].slug;
        }

        this.fetchOrders(true);
        this.countOrders()

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

        countOrders() {
            this.$axios.post('/api/orders/count')
                .then(res => this.countedOrders = res.data)
                .catch(err => console.error(err))
        },

        tabTitle(tab, i) {
            return tab.title + ' <b style=\'color:' + tab.color + '\'>' + this.countedOrders[i] + '</b>'
        },

        showMoreOrders() {
            if (!this.theEnd) {
                this.fetchOrders()
            }
        },
    },
    components: {
        Tabs, Tab, Order,
    },
}
</script>