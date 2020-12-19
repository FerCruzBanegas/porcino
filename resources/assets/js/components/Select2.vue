<template>
  <select class="form-control">
    <slot></slot>
  </select>
</template>
<style src="../../../../node_modules/select2/dist/css/select2.min.css"></style>
<style src="../../../../node_modules/@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css"></style>
<script>
  import Select2 from 'select2';
  export default{
    props: ['options', 'value', 'name', 'urlName', 'nameData', 'flag', 'disabled'],
    mounted() {
      var vm = this
      $(this.$el).select2({
        theme: 'bootstrap4',
        data: this.options,
        placeholder: 'Seleccione una opción',
        allowClear: false,
        disabled: this.disabled
      })
      .val(this.value)
      .trigger('change')
      .on('change', function (e) {
        vm.$emit('input', this.value)
        if (vm.flag) {
          vm.$root.$emit('eventing', this.value);
        }
      })
    },

    watch: {
      value: function (value) {
      // update value
        $(this.$el).val(value).trigger('change');
      },
      options: function (options) {
      // update options
        $(this.$el).select2({ data: options })
      }
    },

    destroyed() {
      $(this.$el).off().select2('destroy')
    }
  }
</script>