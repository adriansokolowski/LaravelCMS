import AdminDasboard from '../components/admin/App.vue';
import MoviesIndex from '../components/admin/movies/Index.vue';
import UsersIndex from '../components/admin/users/Index.vue';
import Home from '../components/admin/Home.vue';

export default {
    mode: 'history',
    routes: [
        {
            path: '/admin/',
            component: Home,
            name: 'home'
        },
        {
            path: '/admin/filmy',
            component: MoviesIndex,
            name: 'admin.movies.index'
        },
        {
            path: '/admin/uzytkownicy',
            component: UsersIndex,
            name: 'admin.users.index'
        }
    ]
}