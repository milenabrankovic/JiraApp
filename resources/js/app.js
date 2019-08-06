require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter)

let routes = [
    { path: '/projects', component: require('./components/ProjectsCrudComponent.vue').default },
    { path: '/configuration', component: require('./components/ConfComponent.vue').default }

  ]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

Vue.component('nav-component', require('./components/NavComponent.vue').default);
Vue.component('project-component', require('./components/ProjectsComponent.vue').default);
Vue.component('project-crud', require('./components/ProjectsCrudComponent.vue').default);
Vue.component('conf-component', require('./components/ConfComponent.vue').default);

const app = new Vue({
    el: '#app',
    router
});


