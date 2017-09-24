<template>
  <input
    type='text'
    class='form-control'
    v-model='value'
    v-bind:id='id'
    v-bind:name='name'
    v-bind:value='value'
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

    if (this.value == undefined || this.value == NaN) this.value = '';
    if (this.format == undefined || this.format == NaN) this.format = 'DD-MM-YYYY hh:mm A';
    if (this.readonly == undefined || this.readonly == NaN) this.readonly = 'false';

    if (this.value == '') {
        this.value = moment().format(this.format);
        vm.$emit('input', moment().format(this.format));
    }

    $(this.$el).datetimepicker({
        useCurrent: false,
        format: this.format,
        defaultDate: moment(this.value, this.format),
        showTodayButton: true,
        showClose: true
    }).on("dp.change", function(e) {
        vm.$emit('input', this.value);
    });
  },
  destroyed: function() {
      $(this.$el).data("DateTimePicker").destroy();
  }
}
</script>
