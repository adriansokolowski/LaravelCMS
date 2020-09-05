require('./bootstrap');

// Vue imports assets

import BootstrapVue from 'bootstrap-vue';
import VueButtonSpinner from 'vue-button-spinner';
import { ContentLoader } from "vue-content-loader";

window.Vue = require('vue');

import VueRouter from 'vue-router'
Vue.use(VueRouter)

Vue.use(ContentLoader);
Vue.use(BootstrapVue);

import routes from './routes'

import App from './components/admin/Dashboard.vue';

Vue.component('button-spinner', VueButtonSpinner);
Vue.component('pagination', require('laravel-vue-pagination'));

// Movies Resource
Vue.component('movie-create', require('./components/movies/Create.vue').default);
Vue.component('movies-index', require('./components/movies/Index.vue').default);
Vue.component('movies-show', require('./components/movies/Show.vue').default);

// Others Resource
Vue.component('movie-all', require('./components/Index.vue').default);

const app = new Vue({
    el: '#app',
    components: { App },
    router: new VueRouter(routes)
});
