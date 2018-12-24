import './bootstrap';

//  Slider
Vue.component('slider', require('./components/slider/Slider.vue'));
Vue.component('cards', require('./components/slider/Cards.vue'));

// Items
Vue.component('items', require('./components/items/Items.vue'));
Vue.component('single-item', require('./components/items/SingleItem.vue'));
Vue.component('items-api', require('./components/items/ItemsApi.vue'));
Vue.component('sidebar', require('./components/items/Sidebar.vue'));

// Other
Vue.component('categories-button', require('./components/CategoriesButton.vue'));
Vue.component('button-back', require('./components/ButtonBack.vue'));
Vue.component('message', require('./components/Message.vue'));
Vue.component('clients-orders', require('./components/ClientsOrders.vue'));

const app = new Vue({
	el: '#app'
});