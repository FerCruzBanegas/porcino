<template>
  <div>
    <vue-snotify/>
    <form @submit.prevent="login" @keydown="form.onKeydown($event)">
      <div class="form-group">
        <label>Username</label>
        <input v-model="form.username" type="text" name="username"
          class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
        <has-error :form="form" field="username"></has-error>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input v-model="form.password" type="password" name="password"
          class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
        <has-error :form="form" field="password"></has-error>
      </div>
      <button :disabled="form.busy" type="submit" class="btn btn-primary">
        <i v-if="form.busy" class="fa fa-spinner fa-spin"></i> 
        <i v-else class="fa fa-sign-in" aria-hidden="true"></i>
        Log In
      </button>
    </form>
  </div>
</template>

<script>
  import { Form, HasError, AlertError } from 'vform'
  export default {
    components: {
      'has-error': HasError
    },

    data () {
      return {
        // Create a new form instance
        form: new Form({
          username: '',
          password: '',
          remember: false
        })
      }
    },

    methods: {
      login () {
        // Submit the form via a POST request
        this.form.post('/login')
        .then(({ data }) => { 
          //window.location.href = '/edit'
          this.$snotify.confirm('Los datos se registraron corréctamente, deséa ver la ficha de cerda?', 'Registrado!', {
            buttons: [
              {text: 'Si', action: () => window.location.href = '/edit', bold: false},
              {text: 'No', action: () => { this.$snotify.remove(); }, bold: true}
            ]
          })
        })
      }
    }  
  }
</script>