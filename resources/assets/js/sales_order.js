
// window.Vue = require('vue');

Vue.use(VeeValidate, { locale: $('html').attr('lang') });

Vue.component('vue-icheck', require('./components/vue-icheck.vue'));
Vue.component('vue-datetimepicker', require('./components/vue-datetimepicker.vue'));
Vue.component('select2_customer', require('./components/select2_customer.vue'));

var soApp = new Vue({
    el: '#soVue',
    data: window.sales_order.data,
    mounted: function() {
        var vm = this;

        if(this.SOs.length == 0) {
            this.insertTab(this.SOs);
        } else {
            for(var i = 0; i < this.SOs.length; i++) {
                if(this.SOs[i].warehouse.id == 0) {
                    this.SOs[i].warehouse = { id: 0 };
                } else {
                    this.SOs[i].warehouse = _.find(this.warehouseDDL, function(warehouse) {
                        return warehouse.id == vm.SOs[i].warehouse.id
                    });
                }

                if(this.SOs[i].vendorTrucking.id == 0) {
                    this.SOs[i].vendorTrucking = { id: 0, name: '' };
                } else {
                    this.SOs[i].vendorTrucking = _.find(this.vendorTruckingDDL, function(vendorTrucking) {
                        return vendorTrucking.id == vm.SOs[i].vendorTrucking.id
                    });
                }
            }
        }
    },
    methods: {
        saveDraft: function(soIndex) {
            this.$validator.validateAll().then(function(isValid) {
                if (!isValid) return;
                $('#loader-container').fadeIn('fast');
                axios.post('/api/post/dashboard/so/save/draft' + '?api_token=' + $('#secapi').val(), new FormData($('#soForm')[0]))
                    .then(function(response) {
                        $('#loader-container').fadeOut('slow');
                        noty({
                            layout: 'topRight',
                            text: 'Draft Updated.',
                            type: 'success',
                            timeout: 3000,
                            progressBar: true
                        });
                    });
            }).catch(function() {

            });
        },
        submitSales: function(soIndex) {
            var vm = this;
            this.$validator.validateAll('tab_' + soIndex).then(function(isValid) {
                $('#loader-container').fadeIn('fast');
                axios.post('/api/post/dashboard/so/create' + '?api_token=' + $('#secapi').val(), vm.SOs[soIndex])
                    .then(function(response) {
                        if (vm.SOs.length == 1) {
                            window.location.href = '/dashboard';
                        } else {
                            vm.SOs.splice(soIndex, 1);
                            $('#loader-container').fadeOut('slow');
                            noty({
                                layout: 'topRight',
                                text: 'Sales Order Created.',
                                type: 'success',
                                timeout: 5000,
                                progressBar: true
                            });
                        }
                    });
            }).catch(function() {

            });
        },
        cancelSales: function(soIndex) {
            if (soIndex == 0) {
                window.location.href = '/dashboard';
            } else {
                this.SOs.splice(soIndex, 1);
            }
        },
        onChangeCustomerType: function(soIndex) {
            var vm = this;

            if(!this.SOs[soIndex].customer_type.code) {
                vm.SOs[soIndex].customer_type = this.defaultCustomerType;
            } else {
                var ct = _.find(this.customerTypeDDL, { code: vm.SOs[soIndex].customer_type.code });
                _.merge(vm.SOs[soIndex].customer_type, ct);
            }
        },
        onSelectCustomer: function(soIndex) {
            var vm = this;

            if(!this.SOs[soIndex].customer.id) {
                vm.SOs[soIndex].customer = { id: '' };
            } else {
                axios.get('/api/get/customer' + '?api_token=' + $('#secapi').val(), { params: { id: vm.SOs[soIndex].customer.id } })
                    .then(function(response) {
                        _.merge(vm.SOs[soIndex].customer, response.data);
                    });
            }
        },
        onChangeUnit: function(soIndex, itemIndex) {
            if (!this.SOs[soIndex].items[itemIndex].selected_unit.id) {
                this.SOs[soIndex].items[itemIndex].selected_unit = this.defaultProductUnit;
            } else {
                var pUnit = _.find(this.SOs[soIndex].items[itemIndex].product.product_units, { id: this.SOs[soIndex].items[itemIndex].selected_unit.id });
                _.merge(this.SOs[soIndex].items[itemIndex].selected_unit, pUnit);
            }
        },
        discountPercentToNominal: function(item, discount){
            var disc_value = ( item.selected_unit.conversion_value * item.quantity * item.price ) * ( discount.disc_percent / 100 );
            if( disc_value % 1 !== 0 )
                disc_value = disc_value.toFixed(2);
            discount.disc_value = disc_value;
        },
        discountNominalToPercent: function(item, discount){
            var disc_percent = discount.disc_value / ( item.selected_unit.conversion_value * item.quantity * item.price ) * 100 ;
            if( disc_percent % 1 !== 0 )
                disc_percent = disc_percent.toFixed(2);
            discount.disc_percent = disc_percent;
        },
        discountItemSubTotal: function (discounts) {
            var result = 0;
            _.forEach(discounts, function (discount) {
                result += parseFloat(discount.disc_value);
            });
            if( result % 1 !== 0 )
                result = result.toFixed(2);
            return result;
        },
        discountTotal: function (index) {
            var vm = this;
            var result = 0;
            _.forEach(vm.SOs[index].items, function (item, key) {
                _.forEach(item.discounts, function (discount) {
                    result += parseFloat(discount.disc_value);
                });
            });
            return result;
        },
        setSOCode: function(so){
            axios.get('/api/get/so/code').then(function(data){
                so.so_code = data.data;
            });
        },
        insertTab: function(SOs){
            var vm = this;

            var so = {
                disc_percent : 0,
                disc_value : 0,
                so_code: '',
                so_created: '',
                shipping_date: '',
                customer_type: { code: '' },
                customer: {
                    id: '',
                    price_level: { name: '' }
                },
                sales_type: {
                    code: ''
                },
                warehouse: {
                    id: ''
                },
                vendorTrucking: {
                    id: '', name: ''
                },
                product: { id: '' },
                stock: { id: '' },
                items : [],
                expenses: [],
                remarks: '',
                internal_remarks: '',
                private_remarks: ''
            };

            vm.setSOCode(so);
            this.SOs.push(so);
        },
        grandTotal: function (index) {
            var vm = this;
            var result = 0;
            _.forEach(vm.SOs[index].items, function (item, key) {
                result += (item.selected_unit.conversion_value * item.quantity * item.price);
            });
            return result;
        },
        expenseTotal: function (index) {
            var vm = this;
            var result = 0;
            _.forEach(vm.SOs[index].expenses, function (expense, key) {
                if(expense.type.code === 'EXPENSETYPE.ADD')
                    result += parseInt(numeral().unformat(expense.amount));
                else
                    result -= parseInt(numeral().unformat(expense.amount));
            });
            return result;
        },
        discountTotalPercentToNominal: function(index){
            var vm = this;

            var grandTotal = 0;
            _.forEach(vm.SOs[index].items, function (item, key) {
                grandTotal += (item.selected_unit.conversion_value * item.quantity * item.price);
            });

            var discountTotal = 0;
            _.forEach(vm.SOs[index].items, function (item, key) {
                _.forEach(item.discounts, function (discount) {
                    discountTotal += parseFloat(discount.disc_value);
                });
            });

            var expenseTotal = 0;
            _.forEach(vm.SOs[index].expenses, function (expense, key) {
                if (expense.type.code === 'EXPENSETYPE.ADD')
                    expenseTotal += parseInt(numeral().unformat(expense.amount));
                else
                    expenseTotal -= parseInt(numeral().unformat(expense.amount));
            });

            var disc_value = ( ( grandTotal - discountTotal ) + expenseTotal ) * ( vm.SOs[index].disc_percent / 100 );
            if( disc_value % 1 !== 0 )
                disc_value = disc_value.toFixed(2);
            vm.SOs[index].disc_value = disc_value;
        },
        discountTotalNominalToPercent: function(index){
            var vm = this;

            var grandTotal = 0;
            _.forEach(vm.SOs[index].items, function (item, key) {
                grandTotal += (item.selected_unit.conversion_value * item.quantity * item.price);
            });

            var discountTotal = 0;
            _.forEach(vm.SOs[index].items, function (item, key) {
                _.forEach(item.discounts, function (discount) {
                    discountTotal += parseFloat(discount.disc_value);
                });
            });

            var expenseTotal = 0;
            _.forEach(vm.SOs[index].expenses, function (expense, key) {
                if (expense.type.code === 'EXPENSETYPE.ADD')
                    expenseTotal += parseInt(numeral().unformat(expense.amount));
                else
                    expenseTotal -= parseInt(numeral().unformat(expense.amount));
            });

            var disc_percent = vm.SOs[index].disc_value / ( ( grandTotal - discountTotal ) + expenseTotal ) * 100 ;
            if( disc_percent % 1 !== 0 )
                disc_percent = disc_percent.toFixed(2);
            vm.SOs[index].disc_percent = disc_percent;
        },
        insertProduct: function (index, product) {
            var vm = this;
            if(product.id != '') {
                var item_init_discount = [];
                item_init_discount.push({
                    disc_percent : 0,
                    disc_value : 0,
                });
                vm.SOs[index].items.push({
                    stock_id: 0,
                    product: _.cloneDeep(product),
                    selected_unit: {
                        id: '',
                        unit: {
                            id: ''
                        },
                        conversion_value: 1
                    },
                    base_unit: _.cloneDeep(_.find(product.product_units, function(unit) {
                        return unit.is_base == 1
                    })),
                    quantity: 0,
                    price: 0,
                    discounts: item_init_discount,
                });
            }
        },
        insertStock: function (index, stock) {
            var vm = this;
            if(stock.id != ''){
                var stock_price = _.find(stock.today_prices, function (price) {
                    return price.price_level_id === vm.SOs[index].customer.price_level_id;
                });
                var item_init_discount = [];
                item_init_discount.push({
                    disc_percent : 0,
                    disc_value : 0,
                });

                vm.SOs[index].items.push({
                    stock_id: stock.id,
                    product: _.cloneDeep(stock.product),
                    selected_unit: {
                        id:'',
                        unit: {
                            id: ''
                        },
                        conversion_value: 1
                    },
                    base_unit: _.cloneDeep(_.find(stock.product.product_units, function(unit) { return unit.is_base == 1 })),
                    quantity: 0,
                    price: stock_price ? stock_price.price : 0,
                    discounts: item_init_discount,
                });
            }
        },
        removeItem: function (SOIndex, index) {
            this.SOs[SOIndex].items.splice(index, 1);
        },
        insertDiscount: function (item) {
            item.discounts.push({
                disc_percent : 0,
                disc_value : 0,
            });
        },
        removeDiscount: function (SOIndex, index, discountIndex) {
            var vm = this;
            this.SOs[SOIndex].items[index].discounts.splice(discountIndex, 1);
        },
        insertDefaultExpense: function (SOIndex, customer) {
            var vm = this;
            if(customer.id != ''){
                vm.SOs[SOIndex].expenses = [];
                for(var i = 0; i < customer.expense_templates.length; i++){
                    vm.SOs[SOIndex].expenses.push({
                        name: customer.expense_templates[i].name,
                        type: {
                            code: customer.expense_templates[i].type,
                            description: _.find(expenseTypes, function(expenseType){ return expenseType.code === customer.expense_templates[i].type})
                        },
                        is_internal_expense: customer.expense_templates[i].is_internal_expense == 1,
                        amount: numeral(customer.expense_templates[i].amount).format('0,0'),
                        remarks: customer.expense_templates[i].remarks
                    });
                }
            }
            else{
                vm.SOs[SOIndex].expenses = [];
            }
        },
        insertExpense: function (index) {
            var vm = this;
            this.SOs[index].expenses.push({
                name: '',
                type: {
                    code: ''
                },
                is_internal_expense: false,
                amount: 0,
                remarks: ''
            });
        },
        removeExpense: function (SOIndex, index) {
            this.SOs[SOIndex].expenses.splice(index, 1);
        },
    },
    computed: {
        defaultCustomerType: function() {
            return {
                code: ''
            };
        },
        defaultSalesType: function() {
            return {
                code: ''
            };
        },
        defaultVendorTrucking: function() {
            return {
                id: '', name: ''
            };
        },
        defaultWarehouse: function() {
            return {
                id: ''
            };
        },
        defaultProductUnit: function() {
            return {
                id: '',
                unit: {
                    id: ''
                },
                conversion_value: 1
            };
        }
    }
});
