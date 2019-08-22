require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

Vue.use(VueRouter)

let routes = [
    { path: '/projects', component: require('./components/ProjectsCrudComponent.vue').default, meta: { auth: true } },
    { path: '/configuration', component: require('./components/ConfComponent.vue').default, meta: { auth: true } },
    { path: '/users', component: require('./components/UserComponent.vue').default, meta: { auth: true } },
    { path: '/login', component: require('./components/LoginComponent.vue').default, meta: { auth: false } }


  ]

const router = new VueRouter({
    mode: 'history',
    routes, // short for `routes: routes`
})

Vue.router=router

Vue.use(require('@websanova/vue-auth'), {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});


Vue.component('nav-component', require('./components/NavComponent.vue').default);
Vue.component('header-component', require('./components/HeaderComponent.vue').default);
Vue.component('project-component', require('./components/ProjectsComponent.vue').default);
Vue.component('project-crud', require('./components/ProjectsCrudComponent.vue').default);
Vue.component('conf-component', require('./components/ConfComponent.vue').default);
Vue.component('user-component', require('./components/UserComponent.vue').default);
Vue.component('login-component', require('./components/LoginComponent.vue').default);

const app = new Vue({
    el: '#app',
    router
});


