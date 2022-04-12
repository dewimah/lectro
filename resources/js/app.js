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
        path: '/login',
        component:require('./components/Login.vue').default,
        meta: {
            auth: false
        }
    },
    {
        path: '/data-bms',
        component:require('./components/bms/Data-bms.vue').default,
        meta: {
            auth: false
        }
    },
    {
        path: '/add-bms',
        component:require('./components/bms/Add-bms.vue').default,
        meta: {
            auth: false
        }
    },
    {
        path: '/edit-bms',
        component:require('./components/bms/Edit-bms.vue').default,
        meta: {
            auth: false
        }
    },
    {
        path: '/data-user',
        name: 'data-user',
        component:require('./components/user/Data-user.vue').default,
        meta: {
            auth: false
        }
    },
    {
        path: '/add-user',
        component:require('./components/user/Add-user.vue').default,
        meta: {
            auth: false
        }
    },
    {
        path: '/edit-user',
        component:require('./components/user/Edit-user.vue').default,
        meta: {
            auth: false
        }
    },
    {
        path: '/user-monitoring',
        component:require('./components/monitoring/User-monitoring.vue').default,
        meta: {
            auth: true
        }
    },
    {
        path: '/admin-monitoring',
        name: 'admin-monitoring',
        component:require('./components/monitoring/Admin-monitoring.vue').default,
        meta: {
            auth: false
        }
    }
]

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const router = new VueRouter({
    routes,
    mode: 'history',
    history: true
})

const app = new Vue({
    el: '#app',
    router
});
