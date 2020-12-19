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
          <input type="text" name="reason" class="form-control" v-model="form.reason" :class="{ 'is-invalid': form.errors.has('reason') }">
          <has-error :form="form" field="reason"></has-error>
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
      abortion: {
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
      if(Object.keys(vm.abortion).length > 0) {
        vm.form.date = vm.abortion.date
        vm.form.reason = vm.abortion.reason
        vm.form.observation = vm.abortion.observation
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
          vm._save = vm.form.post('/abortions/store', vm.form)
        } else {
          vm._save = vm.form.put(`/abortions/${vm.abortion.id}`, vm.form)
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