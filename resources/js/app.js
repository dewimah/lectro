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
  
  let routes =[
      {
          path: '/',
          name: 'home',
          component: require('../home/Index.vue')
      },
      {
        path: '/halaman-login',
        name: 'halaman-login',
        component: require('../views/auth/login.vue')
      },
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
        path: '/data-bmx',
        name: 'data-bmx',
        component:require('./components/bms/Data-bmx.vue').default,
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
        path: '/add-cell',
        name: 'add-cell',
        component:require('./components/bms/Add-cell.vue').default,
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
      },
      {
        path: '/halaman-setting',
        name: 'halaman-setting',
        component:require('./components/monitoring/Setting.vue').default,
        meta: {
            auth: false
        }
      },
      {
        path: '/add-setting',
        name: 'add-setting',
        component:require('./components/bms/setting/Add-setting.vue').default,
        meta: {
            auth: false
        }
      },
      {
        path: '/edit-setting',
        name: 'edit-setting',
        component:require('./components/bms/setting/Edit-setting.vue').default,
        meta: {
            auth: false
        }
      },
      {
        path: '/halaman-detail',
        name: 'halaman-detail',
        component:require('./components/monitoring/Detail.vue').default,
        meta: {
            auth: false
        }
      },
  ]
  
  Vue.component('example-component', require('./components/ExampleComponent.vue').default);
  Vue.component('welcome-component', require('./components/WelcomeComponent.vue').default);
  Vue.component('nav-component', require('./components/NavComponent.vue').default);
  
  const router = new VueRouter({
      routes,
      mode: 'history',
      history: true
  });
  
  const app = new Vue({
      el: '#app',
      router
  });

  //const validation = ref([]);
