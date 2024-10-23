require('./bootstrap');

// import "./plugins.js";
// import "./main.js";

window.Vue = require('vue');

// Vue text editor
import Vue2Editor from "vue2-editor";
Vue.use(Vue2Editor);

//Vuex for state management
import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from './store/index';
const store = new Vuex.Store(
    storeData
)

//moment js
import { filter } from './filter'

// Vue Router
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import { routes } from './routes';
Vue.component('admin-main', require('./components/admin/AdminMaster.vue').default);
Vue.component('home-main', require('./components/public/PublicMaster.vue').default);

// v-form
import { Form, HasError, AlertError } from 'vform'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form;

// sweet alert start
import swal from 'sweetalert2'
window.swal = swal;
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
})
window.toast = toast

const router = new VueRouter({
    routes,
    mode: 'history'
})

const app = new Vue({
    el: '#app',
    router,
    store
});