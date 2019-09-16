require('./bootstrap');

window.Vue = require('vue');



import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';

import VueFlashMessage from '../src';
Vue.use(VueFlashMessage);
require('vue-flash-message/dist/vue-flash-message.min.css');

Vue.use(VueAxios, axios);

Vue.use(VueRouter);


let routes = [
  { path: '/', redirect:'/dashboard', meta: { auth: true, title: "Dashboard" }, props: true },
  { path: '/dashboard',component: require('./components/DashboardComponent.vue').default, meta: { auth: true, title: "Dashboard" }, props: true },
  { path: '/projects',component: require('./components/ProjectsCrudComponent.vue').default, meta: { auth: true, title: "Projects" }, props: true },
  { path: '/user_projects', component: require('./components/ProjectsComponent.vue').default, meta: { auth: true, title: "Projects" } },
  { path: '/configuration', component: require('./components/ConfComponent.vue').default, meta: { auth: true, title: "Configuration" } },
  { path: '/users', component: require('./components/UserComponent.vue').default, meta: { auth: true, title: "Users" } },
  { path: '/login', component: require('./components/LoginComponent.vue').default, meta: { auth: false, title: "Login" } },
  { path: '/tasks', name: 'tasks', component: require('./components/TasksComponent.vue').default, meta: { auth: true, title: "Tasks" }, props: true }
];



const router = new VueRouter({
    mode: 'history',
    routes, // short for `routes: routes`
});

// This callback runs before every route change, including on page load.
router.beforeEach((to, from, next) => {
  // This goes through the matched routes from last to first, finding the closest route with a title.
  // eg. if we have /some/deep/nested/route and /some, /deep, and /nested have titles, nested's will be chosen.
  const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);

  // Find the nearest route element with meta tags.
  const nearestWithMeta = to.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);
  const previousNearestWithMeta = from.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);

  // If a route with a title was found, set the document (page) title to that value.
  if(nearestWithTitle) document.title = nearestWithTitle.meta.title;

  // Remove any stale meta tags from the document using the key attribute we set below.
  Array.from(document.querySelectorAll('[data-vue-router-controlled]')).map(el => el.parentNode.removeChild(el));

  // Skip rendering meta tags if there are none.
  if(!nearestWithMeta) return next();

  // Turn the meta tag definitions into actual elements in the head.
  nearestWithMeta.meta.metaTags.map(tagDef => {
    const tag = document.createElement('meta');

    Object.keys(tagDef).forEach(key => {
      tag.setAttribute(key, tagDef[key]);
    });

    // We use this to track which meta tags we create, so we don't interfere with other ones.
    tag.setAttribute('data-vue-router-controlled', '');

    return tag;
  })
  // Add the meta tags to the document head.
  .forEach(tag => document.head.appendChild(tag));

  next();
});


router.beforeEach((to, from, next) => {

  const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);

  if (nearestWithTitle) document.title = nearestWithTitle.meta.title;

  next();
});

Vue.router=router

Vue.use(require('@websanova/vue-auth'), {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});

Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);
Vue.component('nav-component', require('./components/NavComponent.vue').default);
Vue.component('header-component', require('./components/HeaderComponent.vue').default);
Vue.component('project-component', require('./components/ProjectsComponent.vue').default);
Vue.component('project-crud', require('./components/ProjectsCrudComponent.vue').default);
Vue.component('conf-component', require('./components/ConfComponent.vue').default);
Vue.component('user-component', require('./components/UserComponent.vue').default);
Vue.component('login-component', require('./components/LoginComponent.vue').default);
Vue.component('task-component', require('./components/LoginComponent.vue').default);

const app = new Vue({
    el: '#app',
    router
});


