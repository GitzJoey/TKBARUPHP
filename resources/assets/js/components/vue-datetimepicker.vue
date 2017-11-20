<template>
  <input
    type='text'
    class='form-control'
    v-model='value'
    v-bind:id='id'
    v-bind:name='name'
    v-bind:format='format'
    v-bind:readonly='readonly'>
</template>

<script>
export default {
  props: [ 'id', 'name', 'value', 'format', 'readonly' ],
  mounted: function () {
    if (typeof window.$ === 'undefined' || typeof window.jQuery === 'undefined') {
      window.alert('jQuery undefined');
      return;
    }
    if (typeof window.$.fn.datetimepicker === 'undefined') {
      window.alert('datetimepicker undefined');
      return;
    }

    var vm = this;

    $(vm.$el).datetimepicker({
        useCurrent: false,
        format: vm.format,
        defaultDate: vm.value ? moment(vm.value, vm.format) : moment(),
        showTodayButton: true,
        showClose: true
    }).on("dp.change", function(e) {
        vm.$emit('input', this.value);
    });
    vm.$emit('input', vm.value ? vm.value : moment().format(vm.format));
  },
  destroyed: function() {
      $(this.$el).data("DateTimePicker").destroy();
  }
}
</script>
