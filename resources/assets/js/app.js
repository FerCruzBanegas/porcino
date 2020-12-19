import './bootstrap'
import Vue from 'vue'
import Snotify from 'vue-snotify'
import store from './store'

Vue.use(Snotify)
Vue.filter('formatDate', require('./filters/formatDate'));

//general
Vue.component('login-form', require('./pages/auth/Login.vue'));
Vue.component('detail-component', require('./components/DetailComponent.vue'));

//locations
Vue.component('locations-list', require('./pages/location/LocationList.vue'));

//reproducers
Vue.component('females-list', require('./pages/reproducer/females/FemalesList.vue'));
Vue.component('female-show', require('./pages/reproducer/females/FemaleShow.vue'));

//groups
Vue.component('group-form', require('./pages/group/GroupForm.vue'));

//inseminations
Vue.component('insemination-form', require('./pages/insemination/InseminationForm.vue'));
Vue.component('insemination-component', require('./pages/insemination/Insemination.vue'));

//weaning
Vue.component('weaning-form', require('./pages/weaning/WeaningForm.vue'));
Vue.component('weaning-component', require('./pages/weaning/Weaning.vue'));

//abortion
Vue.component('abortion-form', require('./pages/abortion/AbortionForm.vue'));
Vue.component('abortion-component', require('./pages/abortion/Abortion.vue'));

//death
Vue.component('death-form', require('./pages/death/DeathForm.vue'));
Vue.component('death-component', require('./pages/death/Death.vue'));

const app = new Vue({
    el: '#app',
    store
});
