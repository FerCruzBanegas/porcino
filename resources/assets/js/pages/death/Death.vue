<template>
  <div class="cardbox">
    <div class="cardbox-body">
      <div class="cardbox-heading">
        <div class="cardbox-title">{{ addSubtitle }}</div>
        <small>Los campos con (*) son obligatorios.</small>
      </div>
      <div class="row">
        <div class="col-md-6">
          <death-form :death="death" :female="female" :females="females">
          </death-form>
        </div>
        <div class="col-md-4 ml-auto">
          <detail-component></detail-component>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      female: {
        required: false,
        type: Number
      },
      females: {
        required: true,
        type: Array
      },
      death: {
        required: false,
        type: Object,
        default: () => ({})
      }
    },
    computed: {
      addSubtitle () {
        if(Object.keys(this.death).length > 0) {
          return 'Editar Baja'
        }
        return 'Registrar Baja'
      }
    }
  }
</script>

