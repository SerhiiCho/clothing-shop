<template>
    <div>
        <div class="row pb-5"
            v-if="orders[0] && orders[0].length !== 0"
        >
            <div class="col-sm-6 col-xl-4"
                v-for="order in orders[0]"
                :key="order.id"
            >
                <div class="card">
                    <a v-if="admin === 1" href="#"
                        :title="deleteNumber + ' ' + order.phone"
                        class="btn btn-success btn-sm"
                        @click="deleteMessage(order.id)"
                    >
                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ clientsOrder }} # {{ order.id }}
                        </h5>
                        <hr />
                        <p class="card-text mb-1">
                            {{ number }}: <strong>{{ order.phone }}</strong>
                        </p>
                        <p class="card-text mb-1">
                            {{ sum }}: <strong>{{ order.total }} {{ hryvnia }}</strong>
                        </p>
                        <p class="card-text mb-1">
                            {{ date }}: <strong>{{ order.created_at }}</strong>
                        </p>
                        <hr />

                        <div class="text-center">
                            <h5>{{ products }}:</h5>
                        </div>

                        <div v-for="(item, i) in order.items" :key="item.id">
                            <hr v-if="i !== 0">
                            <a :href="'/item/' + item.category + '/' + item.slug"
                                :title="item.title"
                                class="d-block"
                            >
                                <i class="fas fa-angle-right"></i> 
                                {{ item.title }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section v-else class="p-1">
            <h5 class="text-center pb-4" v-text="noOrders"></h5>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            orders: []
        }
    },

    props: [
        'sum', 'date', 'number', 'admin', 'products', 'clientsOrder',
        'noOrders', 'deleteNumber', 'deleteThisOrder', 'hryvnia'
    ],

    created() {
        this.getMessages()
    },
    
    methods: {
        getMessages() {
            this.$axios('/api/clients_orders/index')
                .then(res => this.orders.push(res.data.data))
                .catch(err => console.error(err))
        },

        deleteMessage(id) {
            if (confirm(this.deleteThisOrder)) {
                this.$axios.delete(`/api/clients_orders/destroy/${id}`)
                    .then(res => {
                        this.orders = []
                        this.orders.push(res.data.data)
                        this.getMessages()
                    })
                    .catch(error => console.error(error))
            }
        }
    }
}
</script>