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
          <label for="reproducer">Semen *</label>
          <select2  
            :options="semenFetch"
            v-model="form.semen"
          >
          </select2>
          <input class="form-control" type="hidden" name="semen" v-model="form.semen"
            :class="{ 'is-invalid': form.errors.has('semen') }">
          <has-error :form="form" field="semen"></has-error>
        </div>
        <div class="form-group">
          <label for="date">Fecha *</label>
          <input type="date" name="date" class="form-control" v-model="form.date" :class="{ 'is-invalid': form.errors.has('date') }">
          <has-error :form="form" field="date"></has-error>
        </div>
        <div class="form-group">
          <label for="time">Hora *</label>
          <input type="time" name="time" class="form-control" v-model="form.time" :class="{ 'is-invalid': form.errors.has('time') }">
          <has-error :form="form" field="time"></has-error>
        </div>
        <div class="form-group">
          <label for="dose">Dósis</label><br>
          <small>(Puede ingresar un número entero o con decimales)</small>
          <input type="decimal" name="dose" class="form-control" v-model="form.dose" :class="{ 'is-invalid': form.errors.has('dose') }">
          <has-error :form="form" field="dose"></has-error>
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
      insemination: {
        required: false,
        type: Object,
        default: () => ({})
      },
      females: {
        required: true,
        type: Array
      },
      semen: {
        required: true,
        type: Array
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
          semen: null,
          date: '',
          time: '',
          dose: '',
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
      },
      semenFetch() {
        return this.semen.map((obj) => { 
          let nObj = {}
          nObj['id'] = obj.id
          nObj['text'] = obj.code
          return nObj
        })
      }
    },

    created() {
      let vm = this
      if(Object.keys(vm.insemination).length > 0) {
        vm.form.semen = vm.insemination.semen_id
        vm.form.date = vm.insemination.date
        vm.form.time = vm.insemination.time.split(":").slice(0,-1).join(':')
        vm.form.dose = vm.insemination.dose
        vm.form.observation = vm.insemination.observation
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
        if(this.female === 0) {
          vm._save = vm.form.post('/inseminations/store', vm.form)
        } else {
          vm._save = vm.form.put(`/inseminations/${vm.insemination.id}`, vm.form)
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