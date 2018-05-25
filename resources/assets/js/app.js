import { setInterval } from 'core-js';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//  Slider
Vue.component('slider', require('./components/slider/Slider.vue'));
Vue.component('cards', require('./components/slider/Cards.vue'));

// Items
Vue.component('items', require('./components/items/Items.vue'));
Vue.component('single-item', require('./components/items/SingleItem.vue'));
Vue.component('popular', require('./components/items/Popular.vue'));
Vue.component('sidebar', require('./components/items/Sidebar.vue'));

// Other
Vue.component('categories-button', require('./components/CategoriesButton.vue'));
Vue.component('button-back', require('./components/ButtonBack.vue'));
Vue.component('clients-orders', require('./components/ClientsOrders.vue'));


const app = new Vue({
	el: '#app'
});