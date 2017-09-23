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
    var vm = this;

    if (this.value == undefined || this.value == NaN) this.value = '';
    if (this.format == undefined || this.format == NaN) this.format = 'DD-MM-YYYY hh:mm A';
    if (this.readonly == undefined || this.readonly == NaN) this.readonly = 'false';

    $(this.$el).datetimepicker({
        format: this.format,
        defaultDate: this.value == '' ? moment():moment(this.value),
        showTodayButton: true,
        showClose: true
    }).on("dp.change", function(e) {
        vm.$emit('input', this.value);
    });

    if (this.value == '') { vm.$emit('input', moment().format(this.format)); }
  },
  destroyed: function() {
      $(this.$el).data("DateTimePicker").destroy();
  }
}
</script>
