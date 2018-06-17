require('./bootstrap');

// import Vue from 'vue'
// import VueRouter from 'vue-router'
import {routes} from './routes'
// import axios from 'axios'
window.Vue = require('vue');
window.VueRouter=require('vue-router').default;
window.VueAxios=require('vue-axios').default;
window.Axios=require('axios').default;
import Vuetify from 'vuetify';
import {VueMasonryPlugin} from 'vue-masonry';

Vue.use(Vuetify);
Vue.use(VueMasonryPlugin);	
Vue.use(VueRouter, VueAxios, axios);

let Layout= require('./components/Layout.vue');

const router = new VueRouter({
    mode: 'history',
    routes
});

new Vue({
    el: '#app',
    router
});

// window.Vue = require('vue');
// window.VueRouter=require('vue-router').default;
// window.VueAxios=require('vue-axios').default;
// window.Axios=require('axios').default;

// // show the list post template
// const Listposts=Vue.component('Listposts', require('./components/Listposts.vue'));

// // add post template
// const Addpost =Vue.component('Addpost', require('./components/Addpost.vue'));

// // edite post template
// const Editpost =Vue.component('Editpost', require('./components/Editpost.vue'));

// // delete post template
// const Deletepost =Vue.component('Deletepost', require('./components/Deletepost.vue'));

// // view single post template
// const Viewpost =Vue.component('Viewpost', require('./components/Viewpost.vue'));




// const routes = [
//   {
//     name: 'Listposts',
//     path: '/',
//     component: Listposts
//   },
//   {
//     name: 'Addpost',
//     path: '/add-post',
//     component: Addpost
//   },
//   {
//     name: 'Editpost',
//     path: '/edit/:id',
//     component: Editpost
//   },
//   {
//     name: 'Deletepost',
//     path: '/post-delete',
//     component: Deletepost
//   },
//   {
//     name: 'Viewpost',
//     path: '/view/:id',
//     component: Viewpost
//   }
// ];

// const router = new VueRouter({ mode: 'history', routes: routes});

// new Vue(
//  Vue.util.extend(
//  { router },
//  Layout
//  )
// ).$mount('#app');