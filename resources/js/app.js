require('./bootstrap');

  window.Vue = require('vue').default;
  let Fire = new Vue();
  window.Fire = Fire;

  //import alert
  import Swal from 'sweetalert2'
  window.Swal = Swal;
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton:false,
    timer:3000
  });
  window.Toast = Toast;

  //VALIDASI
  import {ValidationObserver, ValidationProvider, extend} from 'vee-validate';
  import {required, email, min, confirmpassword, batasmin, batasmax} from 'vee-validate/dist/rules';
  //TAMBAH RULES
  extend('email', email);
  extend('batasmin', {
    ...required,
    message: 'Minimum 21'
  });
  extend('batasmax', {
    ...required,
    message: 'Maksimum 59'
  });
  extend('confirmpassword', {
    ...required,
    message: 'Password confirmation is incorect'
  });
  extend('min',{
    ...required,
    message: 'Minimum password should be 8'
  });
  extend('required', {
    ...required,
    message: 'This field is required'
  });
  //REGISTER IT GLOBALLY
  Vue.component('ValidationObserver', ValidationObserver);
  Vue.component('ValidationProvider', ValidationProvider);

  
  import Vue from 'vue';
  import VueRouter from 'vue-router'
  import VueAxios from 'vue-axios';
  import Vuex from 'vuex'
  import axios, { Axios } from 'axios';
  Vue.use(VueRouter)
  Vue.use(VueAxios, axios)
  Vue.use(Vuex)

  let routes =[
      {
          path: '/login',
          name: 'login',
          component:require('./components/auth/Login.vue').default,
          meta: {
              auth: false
          }
      },
      {
        path: '/logout',
        name: 'logout',
        component:require('./components/auth/Login.vue').default,
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
        path: '/edit-cell',
        name: 'edit-cell',
        component:require('./components/bms/Edit-cell.vue').default,
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
        path: '/add-setting',
        name: 'add-setting',
        component:require('./components/bms/setting/Add-setting.vue').default,
        meta: {
            auth: false
        }
      },
      {
        path: '/edit-setting/:id',
        name: 'edit-setting',
        component:require('./components/bms/setting/Edit-setting.vue').default,
        meta: {
            auth: false
        }
      },
      {
        path: '/halaman-detail/:id',
        name: 'halaman-detail',
        component:require('./components/monitoring/Detail.vue').default,
        meta: {
            auth: false
        }
      },
      {
        path: '/data-userdevice',
        name: 'data-userdevice',
        component:require('./components/userdevice/Data-userdevice.vue').default,
        meta: {
            auth: false
        }
      },
      {
        path: '/add-userdevice',
        name: 'add-userdevice',
        component:require('./components/userdevice/Add-userdevice.vue').default,
        meta: {
            auth: false
        }
      },
      {
        path: '/edit-userdevice/:id',
        name: 'edit-userdevice',
        component:require('./components/userdevice/Edit-userdevice.vue').default,
        meta: {
            auth: false
        }
      },
  ]
  
  Vue.component('example-component', require('./components/ExampleComponent.vue').default);

  const router = new VueRouter({
      routes,
      mode: 'history',
      history: true
  });


  // router.beforeEach((to, from, next) => {
  //   const isAuthenticated = JSON.parse(localStorage.getItem("token"));

  //   if (isAuthenticated === null) {
  //     window.location.href = "/login"
  //   } else {
  //     router.push({name: "admin-monitoring"})
  //   }

    // if (isAuthenticated === null) next({ name: "login" });
    // if (isAuthenticated !== null) next();
    // else next();
  // })

  // router.beforeEach((to, from, next) => {
  //   if(to.meta.requiresAuth) 
  //   {
  //     const authUser = JSON.parse(window.localStorage.getItem('authUser')
  //     if (authUser && authUser.access_token)
  //     {
  //       next()
  //     }) else {
  //       next({name:'login'})
  //     }
  //   }
  // })
  
  const app = new Vue({
      el: '#app',
      router
  });

  //const validation = ref([]);
