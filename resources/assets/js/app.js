
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';


const VueAuth = require('@websanova/vue-auth');

const App = require('./components/App.vue')
const Dashboard = require('./components/Dashboard');
const AdminLogin = require('./components/AdminLogin')

Vue.use(VueRouter);
Vue.use(VueAxios, axios);


const router = new VueRouter({
    routes : [
        {
            path : '/',
            name : 'dashboard',
            component : Dashboard,
            meta : {
                auth : true
            }
        },{
            path : '/login',
            name : 'login',
            component : AdminLogin,
            meta : {
                auth : false
            }
        }
    ]
});

Vue.router = router;

Vue.use(VueAuth,{
    auth : require('@websanova/vue-auth/drivers/auth/bearer'),
    http : require('@websanova/vue-auth/drivers/http/axios.1.x'),
    router : require('@websanova/vue-auth/drivers/router/vue-router.2.x')
});

App.router=Vue.router;


const app = new Vue({
    el: '#app',
    router: router,
    components : {App}
})
