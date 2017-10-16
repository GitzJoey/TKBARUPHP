<template>
  <select v-model="value" v-bind:placeholder="placeholder">
    <option></option>
  </select>
</template>

<script>
export default {
  props: {
      id: { default: 'id' },
      text: { default: 'name' },
      defaultId: {},
      defaultText: {},
      placeholder: {}
  },
  data: function () {
      return {
          value: this.defaultId,
          suppliers: {}
      }
  },
  model: {
      event: 'select'
  },
  mounted: function(){
      if (typeof window.$ === 'undefined' || typeof window.jQuery === 'undefined') {
        window.alert('jQuery undefined');
        return;
      }
      if (typeof window.$.fn.select2 === 'undefined') {
        window.alert('select2 undefined');
        return;
      }

      var vm = this;
      if (vm.defaultId && vm.defaultText) {
          let option = new Option(vm.defaultText, vm.defaultId, true, true);
          $(vm.$el).append(option).trigger('change');
          vm.$emit('input', vm.defaultId);
      }
      $(vm.$el).select2({
          ajax: {
              url: "/api/get/supplier/search_supplier?q=",
              dataType: 'json',
              data: function(params){
                  return {
                      q: params.term,
                      page: params.page
                  }
              },
              processResults: function (data, params) {
                  params.page = params.page || 1;
                  var output = [];
                  vm.suppliers = data;
                  _.map(data, function(d){
                      output.push({id: d[vm.id], text: d[vm.text] });
                  });
                  return {
                      results: output
                  }
              }
          },
          minimumInputLength: 1,
          placeholder: vm.placeholder
      }).val(vm.defaultId ? vm.defaultId : '').trigger('change').on('change', function(e) {
          vm.$emit('input', e.target.value);
          let supplier = _.find(vm.suppliers, function (supplier) {
              return supplier[vm.id] == e.target.value;
          });
          vm.$emit('select', supplier);
      });
  },
  destroyed: function(){
      $(this.$el).off().select2('destroy');
  }
}
</script>
