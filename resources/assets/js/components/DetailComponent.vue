<template>
  <div class="card border-dark mb-3">
    <div class="card-header text-center">Detalles</div>
    <div class="card-body text-dark">
      <div v-if="flag" class="table-responsive">
        <h5 class="card-title">Datos del Animal</h5>
        <table class="table table-sm">
          <tbody>
            <tr>
              <th scope="row">Código:</th>
              <td>{{ female.female.code }}</td>
            </tr>
            <tr>
              <th scope="row">Condición:</th>
              <td>{{ female.female.condition}}</td>
            </tr>
          </tbody>
        </table>
        <h5 class="card-title">Último Evento</h5>
        <table class="table table-sm">
          <tbody>
            <tr>
              <th scope="row">Tipo:</th>
              <td>{{ female.latest.type }}</td>
            </tr>
            <tr>
              <th scope="row">Fecha:</th>
              <td>{{ female.latest.date | formatDate('DD/MM/YYYY') }}</td>
            </tr>
            <tr v-if="female.latest.type === 'Inseminación'">
              <th scope="row">Dósis:</th>
              <td colspan="2">{{ female.latest.dose }}</td>
            </tr>
            <tr v-else-if="female.latest.type === 'Destete'">
              <th scope="row">Cantidad:</th>
              <td colspan="2">{{ female.latest.quantity }}</td>
            </tr>
            <tr v-else-if="female.latest.type === 'Aborto'">
              <th scope="row">Motivo:</th>
              <td colspan="2">{{ female.latest.reason }}</td>
            </tr>
            <tr v-else-if="female.latest.type === 'Baja'">
              <th scope="row">Motivo:</th>
              <td colspan="2">{{ female.latest.reason }}</td>
            </tr>
            <tr v-else-if="female.latest.type === 'Parto'">
              <th scope="row">Cantidad:</th>
              <td colspan="2">{{ female.latest.quantity }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <h5 v-if="message" class="card-title text-center">Seleccione una reproductora!</h5>
      <div v-show="loader" class="sk-cube-grid">
        <div class="sk-cube sk-cube1"></div>
        <div class="sk-cube sk-cube2"></div>
        <div class="sk-cube sk-cube3"></div>
        <div class="sk-cube sk-cube4"></div>
        <div class="sk-cube sk-cube5"></div>
        <div class="sk-cube sk-cube6"></div>
        <div class="sk-cube sk-cube7"></div>
        <div class="sk-cube sk-cube8"></div>
        <div class="sk-cube sk-cube9"></div>
      </div>
    </div>
    <div v-if="flag" class="card-footer text-muted">
      <a class="nav-link text-center" :href="`/females/${female.female.id}`">Más Info.</a>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        female: [],
        message: true,
        loader: false,
        flag:false
      }
    },

    mounted() {
      this.$root.$on('eventing', data => {
        this.flag = false
        this.message = false
        this.loader = true
        let female = `?id=${data}`
        axios.get(`/females/latest-event${female}`)
        .then((response) => {
          this.female = response.data
          this.loader = false
          this.flag = true
        })
      });
    }
  }
</script>

