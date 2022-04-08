/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueRouter)
Vue.use(VueAxios, axios)

let routes =[
    {
        path: '/',
        component:require('./components/Login.vue').default
    },
    {
        path: '/data-bms',
        component:require('./components/bms/Data-bms.vue').default
    },
    {
        path: '/add-bms',
        component:require('./components/bms/Add-bms.vue').default
    },
    {
        path: '/edit-bms',
        component:require('./components/bms/Edit-bms.vue').default
    },
    {
        path: '/data-user',
        component:require('./components/user/Data-user.vue').default
    },
    {
        path: '/add-user',
        component:require('./components/user/Add-user.vue').default
    },
    {
        path: '/edit-user',
        component:require('./components/user/Edit-user.vue').default
    }
]

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const router = new VueRouter({
    routes
})

const app = new Vue({
    el: '#app',
    router
});
