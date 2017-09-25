<template>
  <input
    v-bind:id='id'
    v-bind:name='name'
    type='checkbox'
    v-bind:disabled='disabled'
    v-model='value'>
</template>

<script>
export default {
  props: ['id', 'name', 'disabled', 'value'],
  mounted: function() {
      if (typeof window.$ === 'undefined' || typeof window.jQuery === 'undefined') {
        window.alert('jQuery undefined');
        return;
      }
      if (typeof window.$.fn.iCheck === 'undefined') {
        window.alert('iCheck undefined');
        return;
      }

      $(this.$el).iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue'
      }).on('ifChecked', function(event) {
          this.value = true;
      }).on('ifUnchecked', function(event) {
          this.value = false;
      });

      if (this.value == true ||
          this.value == 'true' ||
          this.value == 1) { $(this.$el).iCheck('check'); }
      if (this.value == false ||
          this.value == 'false' ||
          this.value == 0) { $(this.$el).iCheck('uncheck'); }
      if (this.disabled == 'true') { $(this.$el).iCheck('disable'); }
  },
  destroyed: function() {
      $(this.$el).iCheck('destroy');
  }
}
</script>
