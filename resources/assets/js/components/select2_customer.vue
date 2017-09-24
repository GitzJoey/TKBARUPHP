<template>
  <select v-model="value">
    <option></option>
  </select>
</template>

<script>
export default {
  props: ['value'],
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
      $(this.$el).select2({
          ajax: {
              url: "/api/get/customer/search_customer?q=",
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
                  _.map(data, function(d){
                      output.push({id: d.id, text: d.name});
                  });
                  return {
                      results: output
                  }
              }
          },
          minimumInputLength: 1
      }).val(this.value).trigger('change').on('change', function() {
          vm.$emit('input', this.value);
          vm.$emit('select', this.value);
      });
  },
  destroyed: function(){
      $(this.$el).off().select2('destroy');
  }
}
</script>
