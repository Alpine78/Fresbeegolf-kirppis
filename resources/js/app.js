
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Router from './routes.js'
import {store} from './store.js'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'



Vue.use(BootstrapVue);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('login', require('./components/auth/Login.vue').default);
Vue.component('logout', require('./components/auth/Logout.vue').default);
Vue.component('register', require('./components/auth/Register.vue').default);
Vue.component('Master', require('./components/layouts/Master.vue').default);
 /**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 Router.beforeEach((to, from, next) => {
     if (to.matched.some(record => record.meta.requiresAuth)) {
         // this route requires auth, check if logged in
         // if not, redirect to login page.
         if (!store.getters.loggedIn) {
             next({
                 path: '/login',
             })
         } else {
             next()
         }
     } else if (to.matched.some(record => record.meta.requiresVisitor)) {
         if (store.getters.loggedIn) {
             next({
                 path: '/',
             })
         } else {
             next()
         }
     }else {
         next() // make sure to always call next()!
     }
 })


const app = new Vue({
     el: '#app',
     router: Router,
     store: store
});
