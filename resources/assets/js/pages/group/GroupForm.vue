<template>
  <div class="card card-default">
    <div class="card-body">
      <alert-error :form="form" message="Hubo algunos problemas con los campos."></alert-error>
      <form @submit.prevent="store" @keydown="form.onKeydown($event)">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="date">Fecha Apertura *</label>
              <input type="date" name="date" class="form-control" v-model="form.date" :class="{ 'is-invalid': form.errors.has('date') }">
              <has-error :form="form" field="date"></has-error>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="code">Código Grupo *</label><br>
              <input type="decimal" name="code" class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }">
              <has-error :form="form" field="code"></has-error>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="location">Ubicación Inicial *</label><br>
              <input type="decimal" name="location" class="form-control" v-model="form.location" :class="{ 'is-invalid': form.errors.has('location') }">
              <has-error :form="form" field="location"></has-error>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="observation">Observación</label>
              <textarea class="form-control" name="observation" rows="3" v-model="form.observation">
              </textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="reproducer">Reproductora *</label>
              <select-multiple  
                :options="femalesFetch"
                v-model="reproducer"
              >
              </select-multiple>
              <pre>{{ reproducer }}</pre>
              <input class="form-control" type="hidden" name="reproducer" v-model="form.reproducer"
                :class="{ 'is-invalid': form.errors.has('reproducer') }">
              <has-error :form="form" field="reproducer"></has-error>
            </div>         
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <div v-if="alert" class="alert alert-warning" role="alert">
                <strong>Alerta!</strong> Revise las siguientes observaciones:<br>
                <ul>
                  <li v-for="item in errors">
                    No debe superar la cantidad disponible de lechones <strong>({{ item.available }})</strong> para la hembra con código: <strong>{{ item.code }}</strong>
                  </li>
                </ul>
              </div>
              <table class="table table-striped table-hover table-sm">
                <thead>
                  <tr>
                    <th colspan="5" class="table-primary text-center">Datos del destete</th>
                    <th colspan="3" class="table-light text-center">Detalle</th>
                  </tr>
                  <tr>
                    <th scope="col" style="width: 25px;">#</th>
                    <th scope="col" style="width: 45px;">Hembra</th>
                    <th scope="col" style="width: 70px;">Fecha Destete</th>
                    <th scope="col" style="width: 70px;">Destetados</th>
                    <th scope="col" style="width: 70px;">Disp.</th>
                    <th scope="col" style="width: 70px;">Lechones M</th>
                    <th scope="col" style="width: 70px;">Lechones H</th>
                    <th scope="col" style="width: 70px;">Cantidad</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in form.items" :key="item.id">
                    <th scope="row">
                      {{ index +1 }}
                    </th>
                    <td>
                      <h3><span class="badge badge-secondary">{{ item.code }}</span></h3>
                    </td>
                    <td>
                      <h3><span class="badge badge-secondary">{{ item.date | formatDate('DD/MM/YYYY') }}</span></h3>
                    </td>
                    <td>
                      <input class="form-control text-right" :value="item.quantity" readonly/>
                    </td>
                    <td>
                      <input class="form-control text-right" :value="item.available" readonly/>
                    </td>
                    <td>
                      <input @keyup="isEmpty(item)" @keypress="isNumber($event)" @focus ="$event.target.select()" class="form-control text-right" v-model.number="item.females"/>
                    </td>
                    <td>
                      <input @keyup="isEmpty(item)" @keypress="isNumber($event)" @focus ="$event.target.select()" class="form-control text-right" v-model.number="item.males"/>
                    </td>
                    <td>
                      <input class="form-control text-right" v-model.number="subtotalRow[index]" readonly/>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="7" class="text-right"><strong>TOTAL</strong></td>
                    <td colspan="1" class="text-right">
                      <strong>{{ total }}</strong>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <button :disabled="form.busy" type="submit" class="btn btn-primary">
          <i v-if="form.busy" class="fa fa-spinner fa-spin"></i> 
          <i v-else class="fa fa-floppy-o" aria-hidden="true"></i>
          Guardar
        </button>
      </form>
    </div>
  </div>
</template>

<script>
  import SelectMultiple from '../../components/SelectMultiple.vue';
  import { Form, HasError, AlertError } from 'vform'

  export default {
    props: {
      females: {
        required: true,
        type: Array
      }
    },

    components: {
      'select-multiple': SelectMultiple,
      'has-error': HasError,
      'alert-error': AlertError
    },

    data() {
      return {
        alert: false,
        errors: [],
        reproducer: [],
        form: new Form({
          date: '',
          code: '',
          location: null,
          observation: '',
          items: []
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

      subtotalRow() {
        return this.form.items.map((item) => {
          return Number(item.females + item.males)
        })
      },

      total() {
        let t = 0
        this.form.items.forEach( (obj) => {
          if (obj.females !== "" && obj.males !== "") {
            t += parseInt(obj.females) + parseInt(obj.males)
          }
        })
        return t
      },
    },

    watch: {
      reproducer (v) {
        let newItem = v.filter(x => !this.form.items.find(o => o.id === x))
        let deleteItem = this.form.items.filter(x => !v.find(o => o === x.id)).map(o=>o.id)
        let pushItem = this.females.filter(o => newItem.find(x => x === o.id)).map((obj) => { 
          let rObj = {}
          rObj['id'] = obj.id
          rObj['weaning'] = obj.weaning
          rObj['code'] = obj.code
          rObj['date'] = obj.date
          rObj['quantity'] = obj.quantity
          rObj['available'] = obj.available
          rObj['females'] = 0
          rObj['males'] = 0
          
          return rObj
        })
        pushItem.forEach((obj) => this.form.items.push(obj))
        let index = this.form.items.findIndex(x => deleteItem.find(o => o === x.id))
        if (index > -1){
          this.form.items.splice(index, 1)
        }
      }
    },

    created() {
      this.reproducer.push(2)
    },

    methods: {
      showGroup() {

      },
      isEmpty(item) {
        item.males === "" ? item.males = 0 : ''
        item.females === "" ? item.females = 0 : ''
      },

      isNumber(evt) {
        evt = (evt) ? evt : window.event
        let charCode = (evt.which) ? evt.which : evt.keyCode;
        if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
          evt.preventDefault()
        } else {
          return true
        }
      },

      isOlder() {
        let t = 0
        this.errors = this.form.items.filter(obj => {
          t = parseInt(obj.females) + parseInt(obj.males)
          return t > obj.available
        }).map(({code, available}) => ({code, available}))
      },

      store() {
        this.alert = false
        this.isOlder()
        if (!this.errors.length > 0) {
          this.form.post('/groups/store')
          .then(({ data }) => { 
            console.log(data)
          })
        } else {
          this.alert = true
        }
      }
    } 
  }
</script>
