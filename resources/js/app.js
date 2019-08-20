require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter)

let routes = [
    { path: '/admin/projects', component: require('./components/ProjectsCrudComponent.vue').default },
    { path: '/admin/configuration', component: require('./components/ConfComponent.vue').default },
    { path: '/admin/users', component: require('./components/UserComponent.vue').default }

  ]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

Vue.component('nav-component', require('./components/NavComponent.vue').default);
Vue.component('header-component', require('./components/HeaderComponent.vue').default);
Vue.component('project-component', require('./components/ProjectsComponent.vue').default);
Vue.component('project-crud', require('./components/ProjectsCrudComponent.vue').default);
Vue.component('conf-component', require('./components/ConfComponent.vue').default);
Vue.component('user-component', require('./components/UserComponent.vue').default);

const app = new Vue({
    el: '#app',
    router
});


