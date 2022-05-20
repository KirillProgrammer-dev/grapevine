require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import Vuetify from './plugins/vuetify'

Vue.use(VueRouter);
Vue.component('App', require('./App.vue').default);

import store from "./store"
import Main from './views-vue/Main.vue'
import Login from './views-vue/Login.vue'
import Register from './views-vue/Register.vue'

const router = new VueRouter({
    mode: 'history',
    routes: [{
        path: '/login',
        name: 'Login',
        component: Login,
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
    },
    {
        path: '/',
        name: 'App',
        component: App,
    },
    ]
});

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    router,
    store,
});