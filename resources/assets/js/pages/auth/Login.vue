<template>
  <section class="h-100">
    <div class="container h-100">
      <div class="row justify-content-md-center h-100">
        <div class="card-wrapper">
          <div class="brand">
            <img src="img/login.png">
          </div>
          <div class="card fat">
            <div class="card-body">
              <h4 class="card-title">Iniciar Sesión</h4>
              <form @submit.prevent="login" @keydown="form.onKeydown($event)">
                <div class="form-group">
                  <label for="email">Correo Electrónico</label>
                  <input v-model="form.email" type="text" name="email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" autofocus>
                  <has-error :form="form" field="email"></has-error>
                </div>
                <div class="form-group">
                  <label for="email">Contraseña</label>
                  <div class="input-group mb-3" id="show_hide_password">
                    <input input v-model="form.password" type="password" name="password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button"><i id="view" class="fa fa-eye-slash" aria-hidden="true"></i></button>
                    </div>
                    <has-error :form="form" field="password"></has-error>
                  </div>
                </div>
                <div class="form-group mt-4">
                  <div class="custom-control custom-checkbox mb-0">
                    <input class="custom-control-input" id="logcheck" type="checkbox" checked>
                    <label class="custom-control-label" for="logcheck">Recuérdame</label>
                  </div>
                </div>
                <div class="form-group no-margin">
                  <button :disabled="form.busy" type="submit" class="btn btn-primary btn-block">
                    <i v-if="form.busy" class="fa fa-spinner fa-spin"></i> 
                    <i v-else class="fa fa-sign-in" aria-hidden="true"></i>
                    Ingresar
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="footer">
            Copyright &copy; F.C.B 2018
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
  import { Form, HasError, AlertError } from 'vform'
  export default {
    components: {
      'has-error': HasError,
      'alert-error' : AlertError
    },

    data () {
      return {
        // Create a new form instance
        form: new Form({
          email: '',
          password: '',
          remember: false
        })
      }
    },

    mounted () {
      $(function() {
      $("#show_hide_password button").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
          $('#show_hide_password input').attr('type', 'password');
          $('#view').addClass( "fa-eye-slash" );
          $('#view').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
          $('#show_hide_password input').attr('type', 'text');
          $('#view').removeClass( "fa-eye-slash" );
          $('#view').addClass( "fa-eye" );
        }
      });
    });
    },

    methods: {
      login () {
        // Submit the form via a POST request
        this.form.post('/login', this.form)
        .then(({ data }) => { 
          this.$store.dispatch('getPermissionsUser')
          .then(()=>{
            window.location.href = '/home'
          })
        })
      }
    }  
  }
</script>