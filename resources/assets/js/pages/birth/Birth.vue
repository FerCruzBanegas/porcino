<template>
  <div class="cardbox">
    <div class="cardbox-body">
      <div class="cardbox-heading">
        <div class="cardbox-title">{{ addSubtitle }}</div>
        <small>Los campos con (*) son obligatorios.</small>
      </div>
      <div class="row">
        <div class="col-md-6">
          <birth-form :birth="birth" :female="female" :females="females">
          </birth-form>
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
      birth: {
        required: false,
        type: Object,
        default: () => ({})
      }
    },
    computed: {
      addSubtitle () {
        if(Object.keys(this.birth).length > 0) {
          return 'Editar Parto'
        }
        return 'Registrar Parto'
      }
    }
  }
</script>

