require('./bootstrap');

window.Vue = require('vue');

Vue.component('nav-component', require('./components/NavComponent.vue').default);
Vue.component('project-component', require('./components/ProjectsComponent.vue').default);

const app = new Vue({
    el: '#app'
});
