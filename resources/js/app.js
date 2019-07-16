require('./bootstrap');

window.Vue = require('vue');

Vue.component('nav-component', require('./components/NavComponent.vue').default);
Vue.component('test-component', require('./components/TestComponent.vue').default);

const app = new Vue({
    el: '#app'
});
