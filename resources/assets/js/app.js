
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

const VueNumeric = require('vue-numeric');

Vue.use(VeeValidate, {
  delay: 100,
  locale: $('html').attr('lang')
});
Vue.use(VueNumeric);

Vue.component('example', require('./components/Example.vue'));
Vue.component('vue-icheck', require('./components/vue-icheck.vue'));
Vue.component('vue-datetimepicker', require('./components/vue-datetimepicker.vue'));
Vue.component('select2_customer', require('./components/select2_customer.vue'));

Vue.mixin({
  methods: {
    numeral: require('numeral')
  }
})

// const app = new Vue({
//     el: '#app'
// });
