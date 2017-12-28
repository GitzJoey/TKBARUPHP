Vue.use(VeeValidate, {
    delay: 100,
    locale: $('html').attr('lang'),
    dictionary: VeeValidateID
});

Vue.component('vue-icheck', require('./components/vue-icheck.vue'));
Vue.component('vue-datetimepicker', require('./components/vue-datetimepicker.vue'));
Vue.component('select2_customer', require('./components/select2_customer.vue'));
Vue.component('select2-supplier', require('./components/select2-supplier.vue'));

Vue.mixin({
    methods: {
        numbro: require('numbro'),
        camelCasingKey: function(value) {
            var object = {};

            if (_.isArray(value)) {
                object = _.map(value, function (v) {
                    return this.camelCasingKey(v);
                }.bind(this));
            } else if (_.isObject(value)) {
                _.forEach(value, function(v, k) {
                    object[_.camelCase(k)] = this.camelCasingKey(v);
                }.bind(this));
            } else {
                object = value;
            }

            return object;
        }
    }
})