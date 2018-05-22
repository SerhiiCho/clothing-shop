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

Vue.component('clients-orders', require('./components/ClientsOrders.vue'));
Vue.component('items-sidebar', require('./components/ItemsSidebar.vue'));
Vue.component('single-item', require('./components/SingleItem.vue'));
Vue.component('popular', require('./components/Popular.vue'));
Vue.component('sidebar', require('./components/Sidebar.vue'));
Vue.component('slider', require('./components/Slider.vue'));
Vue.component('items', require('./components/Items.vue'));


const app = new Vue({
	el: '#app'
});