require('./bootstrap.js')

import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';
import Ad from './components/Ad.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Personal from './components/Personal';

import ElementUI from 'element-ui';

import 'element-ui/lib/theme-chalk/index.css';

import lang from 'element-ui/lib/locale/lang/en';
import locale from 'element-ui/lib/locale';
import VueLang from 'vuejs-localization';

VueLang.requireAll(require.context('./lang', true, /\.js$/));

locale.use(lang);

Vue.use(ElementUI);
Vue.use(VueLang);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
axios.defaults.baseURL = window.location.origin + '/api';

const baseRoutes = [
    {
        path: '/personal',
        name: 'personal',
        component: Personal
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    }, {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/:country?/:city?',
        name: 'home',
        component: Home
    },
];

const router = new VueRouter({
    mode: 'history',
    routes: baseRoutes,
});

Vue.router = router
Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});
App.router = Vue.router
new Vue(App).$mount('#app');
