<template>
  <div class="card card-default">
    <vue-snotify/>
    <div class="card-body">
      <form @submit.prevent="submit" @keydown="form.onKeydown($event)">
        <alert-error :form="form" message="Hubo algunos problemas con los campos."></alert-error>
        <div class="form-group">
          <label for="reproducer">Reproductora *</label>
          <select2  
            :options="femalesFetch"
            v-model="form.reproducer"
            :flag="true"
            :disabled="female === 0 ? false : true"
          >
          </select2>
          <input class="form-control" type="hidden" name="reproducer" v-model="form.reproducer"
            :class="{ 'is-invalid': form.errors.has('reproducer') }">
          <has-error :form="form" field="reproducer"></has-error>
        </div>
        <div class="form-group">
          <label for="date">Fecha *</label>
          <input type="date" name="date" class="form-control" v-model="form.date" :class="{ 'is-invalid': form.errors.has('date') }">
          <has-error :form="form" field="date"></has-error>
        </div>
        <div class="form-group">
          <label for="reason">Motivo *</label><br>
          <select name="reason" class="form-control" v-model="form.reason" :class="{ 'is-invalid': form.errors.has('reason') }">
            <option>BAJA VIABILIDAD</option>
            <option>INANICIÓN</option>
            <option>LESIÓN O TRAUMA</option>
            <option>OTRA/DESCONOCIDA</option>
          </select>
          <has-error :form="form" field="reason"></has-error>
        </div>
        <div class="form-group">
          <label for="weight">Peso </label><br>
          <small>(Puede ingresar un número entero o con decimales)</small>
          <input type="decimal" name="weight" class="form-control" v-model="form.weight" :class="{ 'is-invalid': form.errors.has('weight') }">
          <has-error :form="form" field="weight"></has-error>
        </div>
        <div class="form-group">
          <label for="observation">Observación</label>
          <textarea class="form-control" name="observation" rows="2" v-model="form.observation">
          </textarea>
        </div>
        <button :disabled="form.busy" type="submit" class="btn btn-primary">
          <i v-if="form.busy" class="fa fa-spinner fa-spin"></i> 
          <i v-else class="fa fa-floppy-o" aria-hidden="true"></i>
          {{ female === 0 ? 'Guardar' : 'Actualizar' }}
        </button>
        <button type="button" class="btn btn-info float-right">
          <i class="fa fa-refresh" aria-hidden="true"></i>
          Limpiar
        </button>
      </form>
    </div>
  </div>
</template>

<script>
  import Select2 from '../../components/Select2.vue';
  import { Form, HasError, AlertError } from 'vform'

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

    components: {
      'select2': Select2,
      'has-error': HasError,
      'alert-error': AlertError
    },

    data() {
      return {
        form: new Form({
          reproducer: null,
          date: '',
          reason: '',
          weight: null,
          observation: ''
        })
      }
    },

    computed: {
      femalesFetch() {
        return this.females.map((obj) => { 
          let nObj = {}
          nObj['id'] = obj.id
          nObj['text'] = obj.code
          return nObj
        })
      }
    },

    created() {
      let vm = this
      if(Object.keys(vm.death).length > 0) {
        vm.form.date = vm.death.date
        vm.form.reason = vm.death.reason
        vm.form.weight = vm.death.weight
        vm.form.observation = vm.death.observation
      }
    },

    mounted() {
      let vm = this
      let female = vm.females.filter(o => o.id === vm.female)
      if (female.length > 0) {
        vm.form.reproducer = vm.female
        vm.$root.$emit('eventing', vm.female);
      }
    },

    methods: {
      submit() {
        let vm = this
        if(vm.female === 0) {
          vm._save = vm.form.post('/deaths/store', vm.form)
        } else {
          vm._save = vm.form.put(`/deaths/${vm.death.id}`, vm.form)
        }
        vm._save
        .then(response => {
          if(response.data.success) {
            vm.$snotify.confirm('Ver ficha de la reproductora?', 'Registrado!', {
              closeOnClick: false,
              position: "rightBottom",
              buttons: [
                {text: 'Si', action: () => window.location.href = `/females/${response.data.female}`, bold: false},
                {text: 'No', action: (toast) => { vm.$snotify.remove(toast.id); } },
              ]
            })
          }
        })
      }
    } 
  }
</script>