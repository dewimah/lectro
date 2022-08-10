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
      //DATA BMS
      {
          path: '/data-bms',
          name: 'data-bms',
          component:require('./components/bms/Data-bms.vue').default,
          meta: {
              requiresAuth: true,
              isAdmin: true
          }
      },
      {
          path: '/add-bms',
          name: 'add-bms',
          component:require('./components/bms/Add-bms.vue').default,
          meta: {
            requiresAuth: true,
            isAdmin: true
          }
      },
      {
        path: '/edit-bms/:id',
        name: 'edit-bms',
        component:require('./components/bms/Edit-bms.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },

      // CELL
      {
        path: '/add-cell',
        name: 'add-cell',
        component:require('./components/bms/Add-cell.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },
      {
        path: '/edit-cell',
        name: 'edit-cell',
        component:require('./components/bms/Edit-cell.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },

      //SETTING
      {
        path: '/add-setting',
        name: 'add-setting',
        component:require('./components/bms/setting/Add-setting.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },
      {
        path: '/edit-setting/:id',
        name: 'edit-setting',
        component:require('./components/bms/setting/Edit-setting.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },
      {
        path: '/add-setting-suhu',
        name: 'add-setting-suhu',
        component:require('./components/bms/Add-setting-suhu.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },
      {
        path: '/edit-setting-suhu/:id',
        name: 'edit-setting-suhu',
        component:require('./components/bms/Edit-setting-suhu.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },
      {
        path: '/add-setting-tegangan',
        name: 'add-setting-tegangan',
        component:require('./components/bms/Add-setting-tegangan.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },
      {
        path: '/edit-setting-tegangan/:id',
        name: 'edit-setting-tegangan',
        component:require('./components/bms/Edit-setting-tegangan.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },
      {
        path: '/add-setting-arus',
        name: 'add-setting-arus',
        component:require('./components/bms/Add-setting-arus.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },
      {
        path: '/edit-setting-arus/:id',
        name: 'edit-setting-arus',
        component:require('./components/bms/Edit-setting-arus.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },
      
      //DATA USER
      {
          path: '/data-user',
          name: 'data-user',
          component:require('./components/user/Data-user.vue').default,
          meta: {
            requiresAuth: true,
            isAdmin: true
          }
      },
      {
          path: '/add-user',
          name: 'add-user',
          component:require('./components/user/Add-user.vue').default,
          meta: {
            requiresAuth: true,
            isAdmin: true
          }
      },
      {
          path: '/edit-user/:id',
          name: 'edit-user',
          component:require('./components/user/Edit-user.vue').default,
          meta: {
            requiresAuth: true,
            isAdmin: true
          }
      },

      //MONITORING USER
      {
          path: '/user-monitoring',
          name: 'user-monitoring',
          component:require('./components/monitoring/User-monitoring.vue').default,
          meta: {
            requiresAuth: true,
            isUser: true
          }
      },
      {
        path: '/halaman-detail-user/:id',
        name: 'halaman-detail-user',
        component:require('./components/monitoring/Detail-user-monitoring.vue').default,
        meta: {
            requiresAuth: true,
            isUser: true
          }
      },
      {
        path: '/rekapdata-user/:id',
        name: 'rekapdata-user',
        component:require('./components/dashboard/rekap-data-user.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },

      //MONITORING ADMIN
      {
          path: '/admin-monitoring',
          name: 'admin-monitoring',
          component:require('./components/monitoring/Admin-monitoring.vue').default,
          meta: {
            requiresAuth: true,
            isAdmin: true
          }
      },
      {
        path: '/halaman-detail/:id',
        name: 'halaman-detail',
        component:require('./components/monitoring/Detail.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },

      //USER DEVICE
      {
        path: '/data-userdevice',
        name: 'data-userdevice',
        component:require('./components/userdevice/Data-userdevice.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },
      {
        path: '/add-userdevice',
        name: 'add-userdevice',
        component:require('./components/userdevice/Add-userdevice.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },
      {
        path: '/edit-userdevice/:id',
        name: 'edit-userdevice',
        component:require('./components/userdevice/Edit-userdevice.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },

      //DASHBOARD
      {
        path: '/dashboard-admin',
        name: 'dashboard-admin',
        component:require('./components/dashboard/dashboard-admin.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        }
      },

      //REQUEST PAK RUDI
      {
        path: '/rudi',
        name: 'rudi',
        component:require('./components/dashboard/rudi.vue').default,
        meta: {
          requiresAuth: true,
          isAdmin: true
        } 
      },

  ]
  
  Vue.component('example-component', require('./components/ExampleComponent.vue').default);

  const router = new VueRouter({
      routes,
      mode: 'history',
      history: true
  });

  const app = new Vue({
      el: '#app',
      router
  });

