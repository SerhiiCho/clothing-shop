<template>
    <div class="col-sm-6 col-lg-4 col-xl-3 mb-4">
        <div class="card position-relative"
            :style="'border-top: 4px solid ' + color"
        >
            <!-- Take order button for Open orders tab -->
            <form :action="'/admin/orders/' + order.id"
                method="post" 
                v-if="slug === 'opened'"
            >
                <input type="hidden" name="_token" :value="csrf">
                <button type="submit"
                    class="py-2 btn btn-sm btn-block bg-transparent"
                    style="color:#106d17"
                >
                    <i class="fas fa-check"></i> {{ takeOrder }}
                </button>
            </form>

            <div v-if="slug === 'taken'">

                <!-- Title "Taken by" for the Taken tab -->
                <div v-if="order.user.id != userId">
                    <span class="btn btn-sm py-2" style="color:#6567da">
                        <i class="fas fa-sync-alt fa-spin"></i> {{ takenBy }}: 
                        {{ order.user.name }}
                    </span>
                </div>

                <div v-else>
                    <!-- Untake the order -->
                    <form :action="'/admin/orders/' + order.id" method="post">
                        <input type="hidden" name="_token" :value="csrf">
                        <button type="submit"
                            class="py-2 btn btn-sm btn-block bg-transparent"
                            style="color:#e56114"
                        >
                            <i class="fas fa-times"></i> 
                            {{ untakeOrder }}
                        </button>
                    </form>
                </div>

                <!-- Close order -->
                <form :action="'/admin/orders/' + order.id"
                    method="post"
                    @submit.prevent="confirm(closeThisOrder, $event)"
                >
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="_method" value="put">
                    <button type="submit"
                        class="btn btn-sm btn-block bg-transparent"
                        style="color:#e56114"
                        :disabled="order.user.id != userId"
                    >
                        <i class="fas fa-ban"></i> {{ closeOrder }}
                    </button>
                </form>
            </div>

            <!-- Delete order for closed tab -->
            <div v-if="slug === 'closed'">
                <form :action="'/admin/orders/' + order.id"
                    method="post"
                    @submit.prevent="confirm(deleteThisOrder, $event)"
                >
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="_method" value="delete">
                    <button type="submit"
                        class="py-2 btn btn-sm btn-block bg-transparent"
                        style="color:brown"
                    >
                        <i class="fas fa-trash-alt"></i> {{ deleteOrder }}
                    </button>
                </form>
            </div>

            <div class="card-body">
                <!-- Order ID -->
                <h6 class="card-title">
                    {{ clientOrder }} # {{ order.id }}
                </h6>

                <hr />

                <!-- Name -->
                <h6 class="card-title">
                    {{ name }}: <strong>{{ order.name }}</strong>
                </h6>

                <!-- Phone number -->
                <p class="card-text mb-1">
                    {{ number }}: <strong>{{ order.phone }}</strong>
                </p>

                <!-- Sum -->
                <p class="card-text mb-1">
                    {{ sum }}: <strong>{{ order.total }} {{ hryvnia }}</strong>
                </p>

                <!-- Date -->
                <p class="card-text mb-1">
                    {{ date }}: <strong>{{ order.created_at }}</strong>
                </p>

                <hr />

                <!-- Items -->
                <div class="text-center pb-2">
                    <h6>
                        {{ products }}: 
                        <b :style="'color:' + color">{{ order.items.length }}</b>
                    </h6>
                </div>

                <div v-for="(item, i) in order.items" :key="item.id">
                    <hr v-if="i !== 0">
                    <a :href="'/item/' + item.category + '/' + item.slug"
                        :title="item.title"
                        class="d-block"
                        :style="'color:' + color"
                    >
                        <i class="fas fa-angle-right"></i> 
                        {{ item.title }}
                    </a>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            csrf: Laravel.csrfToken,
        }
    },

    props: [
        'color',
        'order',
        'slug',
        'takeOrder',
        'untakeOrder',
        'deleteOrder',
        'deleteThisOrder',
        'closeThisOrder',
        'clientOrder',
        'takenBy',
        'number',
        'name',
        'sum',
        'date',
        'products',
        'hryvnia',
        'userId',
        'closeOrder',
    ],

    methods: {
        confirm(msg, event) {
            if (confirm(msg)) {
                event.target.submit()
            }
        }
    },
}
</script>