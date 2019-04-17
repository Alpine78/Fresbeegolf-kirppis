
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
Vue.component('App', require('./components/App.vue').default);
Vue.component('register', require('./components/auth/Register.vue').default);
Vue.component('login', require('./components/auth/Login.vue').default);
Vue.component('logout', require('./components/auth/Logout.vue').default);
Vue.component('profile', require('./components/Profile.vue').default);
Vue.component('AdvertBody', require('./components/advert/AdvertBody').default);
Vue.component('AdvertForm', require('./components/advert/AdvertForm').default);
Vue.component('AdvertDescription', require('./components/advert/AdvertDescription').default);
Vue.component('AdvertMessages', require('./components/advert/AdvertMessages').default);
Vue.component('AdvertPhoto', require('./components/advert/AdvertPhoto').default);
Vue.component('PhotoGallery', require('./components/advert/PhotoGallery').default);
Vue.component('SellerInfo', require('./components/advert/SellerInfo').default);
Vue.component('ChatBody', require('./components/chat/ChatBody').default);
Vue.component('ChatMessage', require('./components/chat/ChatMessage').default);
Vue.component('ChatLog', require('./components/chat/ChatLog').default);
Vue.component('ChatComposer', require('./components/chat/ChatComposer').default);
Vue.component('ChatList', require('./components/chat/ChatList').default);
Vue.component('ChatConversation', require('./components/chat/ChatConversation').default);
Vue.component('NavBar', require('./components/navbar/NavBar.vue').default);
Vue.component('UserBlock', require('./components/navbar/UserBlock').default);
Vue.component('PageFooter', require('./components/navbar/PageFooter.vue').default);
Vue.component('SearchBar', require('./components/search/SearchBar').default);
Vue.component('SearchDescription', require('./components/search/SearchDescription').default);
Vue.component('SearchInfo', require('./components/search/SearchInfo').default);
Vue.component('SearchPhoto', require('./components/search/SearchPhoto').default);
Vue.component('SearchResultItem', require('./components/search/SearchResultItem').default);
Vue.component('SearchResults', require('./components/search/SearchResults').default);
Vue.component('AdminView', require('./components/admin/Admin').default);
Vue.component('ModerateAdverts', require('./components/admin/ModerateAdverts').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const Advert = {
    template: `<div>Advert {{ $route.params.id }}</div>`
  }

 Router.beforeEach((to, from, next) => {
     if (to.matched.some(record => record.meta.requiresAuth)) {
         // this route requires auth, check if logged in
         // if not, redirect to login page.
         if (!store.getters.loggedIn) {
             next({
                 path: '/kirjaudu',
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
