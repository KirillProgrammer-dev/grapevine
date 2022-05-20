require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import Vuetify from './plugins/vuetify'

Vue.use(VueRouter);

import store from "./store"
import App from './App.vue'
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
        name: 'Main',
        component: Main,
    },
    ]
});

const app = new Vue({
    vuetify: Vuetify,
    router,
    store,
    render: (h) => h(App),
}).$mount('#app');