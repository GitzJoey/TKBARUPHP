
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VeeValidate, { locale: $('html').attr('lang') });

Vue.component('example', require('./components/Example.vue'));
Vue.component('vue-numeric', require('./components/vue-numeric.vue'));
Vue.component('vue-icheck', require('./components/vue-icheck.vue'));
Vue.component('vue-datetimepicker', require('./components/vue-datetimepicker.vue'));
Vue.component('select2_customer', require('./components/select2_customer.vue'));

const app = new Vue({
    el: '#app'
});
