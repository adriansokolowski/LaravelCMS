/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import BootstrapVue from 'bootstrap-vue'

require('./bootstrap');

window.Vue = require('vue');
Vue.use(BootstrapVue)

// Vue assets
import Multiselect from 'vue-multiselect';
import VueButtonSpinner from 'vue-button-spinner';
import InputTag from 'vue-input-tag';
// import { ContentLoader } from "vue-content-loader";

// Vue.use({ContentLoader});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('multi-select', Multiselect);
Vue.component('button-spinner', VueButtonSpinner);
Vue.component('input-tag', InputTag)
Vue.component('pagination', require('laravel-vue-pagination'));


// Movies Resource
Vue.component('movie-create', require('./components/movies/Create.vue').default);
Vue.component('movies-index', require('./components/movies/Index.vue').default);
Vue.component('movies-show', require('./components/movies/Show.vue').default);

// Others Resource
Vue.component('categories', require('./components/Category.vue').default);
Vue.component('movie-all', require('./components/Index.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
