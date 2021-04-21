import './bootstrap';

window.Event = new Vue();

//  Slider
Vue.component('slider', require('./components/slider/Slider.vue'));
Vue.component('cards', require('./components/slider/Cards.vue'));

// Items
Vue.component('items', require('./components/items/Items.vue'));
Vue.component('single-item', require('./components/items/SingleItem.vue'));
Vue.component('items-api', require('./components/items/ItemsApi.vue'));
Vue.component('delete-item-btn', require('./components/items/DeleteItemBtn.vue'));

// Other
Vue.component('categories-button', require('./components/CategoriesButton.vue'));
Vue.component('message', require('./components/Message.vue'));
Vue.component('orders', require('./components/Orders.vue'));
Vue.component('order', require('./components/Order.vue'));
Vue.component('tabs', require('./components/Tabs.vue'));
Vue.component('tab', require('./components/Tab.vue'));

const app = new Vue({
    el: '#app'
});