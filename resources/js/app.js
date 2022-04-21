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
import Vuex from 'vuex'
import axios from 'axios';
Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(Vuex)
/*
export default new Vuex.store({
    state: {
        User: null
    },
    mutations: {
        setUserData (state, userData){
            state.user = userData
            localStorage.setItem('User', JSON.stringify(userData))
            axios.defaults.headers.common.Authorization = 'Bearer ${userData.token}'
        },
        clearUserData() {
            localStorage.removeItem('User')
            location.reload()
        }
    },
    actions: {
        login ({commit}, credentials){
            return axios
            .post('http://127.0.0.1:8000/api/login/', credentials)
            .then(({data}) => {
                commit('setUserData', data)
            })
        }
    },
    getters : {
        isLogged: state => !!state.user
    }
})
*/
let routes =[
    {
        path: '/login',
        name: 'login',
        component:require('./components/Login.vue').default,
        meta: {
            auth: false
        }
    },
    {
        path: '/data-bms',
        name: 'data-bms',
        component:require('./components/bms/Data-bms.vue').default,
        meta: {
            auth: false
        }
    },
    {
        path: '/add-bms',
        name: 'add-bms',
        component:require('./components/bms/Add-bms.vue').default,
        meta: {
            auth: false
        }
    },
    {
        path: '/edit-bms/:id',
        name: 'edit-bms',
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
        name: 'add-user',
        component:require('./components/user/Add-user.vue').default,
        meta: {
            auth: false
        }
    },
    {
        path: '/edit-user/:id',
        name: 'edit-user',
        component:require('./components/user/Edit-user.vue').default,
        meta: {
            auth: false
        }
    },
    {
        path: '/user-monitoring',
        name: 'user-monitoring',
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
/*
router.beforeEach((to, from, next) => {
    const loggendIn = localStorage.getItem('User')

    if (to.matched.some(record => record.meta.auth) && !loggendIn){
        next('/login')
        return
    }
    next()
})
*/
const app = new Vue({
    el: '#app',
    router,
    /*store,
    created () {
        const userInfo = localStorage.getItem('User')
        if (userInfo) {
            const userData = JSON.parse(userInfo)
            this.$store.commit('setUserData', userData)
        }
        axios.interceptors.response.use(
            response => response,
            error => {
                if (error.response.status === 401) {
                    this.$store.dispatch('logout')
                  }
                  return Promise.reject(error)
            }
        )
    }*/
});
