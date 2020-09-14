require('./bootstrap');

import VueTypeaheadBootstrap from 'vue-typeahead-bootstrap';

// Vue imports assets

import BootstrapVue from 'bootstrap-vue';
import VueButtonSpinner from 'vue-button-spinner';
import { ContentLoader } from "vue-content-loader";
import BootstrapSidebar from 'vue-bootstrap-sidebar';

import { library } from '@fortawesome/fontawesome-svg-core'
import { faEdit, faList, faTrashAlt, faDotCircle } from '@fortawesome/free-solid-svg-icons'

import VueSweetalert2 from 'vue-sweetalert2';

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faEdit, faList, faTrashAlt, faDotCircle)

window.Vue = require('vue');

Vue.use(VueSweetalert2);

Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false

import VueRouter from 'vue-router'
Vue.use(VueRouter)

Vue.use(ContentLoader);
Vue.use(BootstrapVue);
Vue.component('vue-typeahead-bootstrap', VueTypeaheadBootstrap)
Vue.use(BootstrapSidebar);

import routes from './routes'

import App from './components/admin/App.vue';
import Vue from 'vue';
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('button-spinner', VueButtonSpinner);
Vue.component('pagination', require('laravel-vue-pagination'));

// Searchbar
Vue.component('ucp', require('./components/ucp/Index.vue').default);
Vue.component('searchbar', require('./components/Search.vue').default);

// Movies Resource
Vue.component('movie-create', require('./components/movies/Create.vue').default);
Vue.component('movies-index', require('./components/movies/Index.vue').default);
Vue.component('movies-show', require('./components/movies/Show.vue').default);
Vue.component('categories', require('./components/Category.vue').default);

// Others Resource
Vue.component('movie-all', require('./components/Index.vue').default);

import Vuetify from 'vuetify';
Vue.use(Vuetify);

const app = new Vue({
    el: '#app',
    components: { App },
    router: new VueRouter(routes),
    vuetify: new Vuetify()
})