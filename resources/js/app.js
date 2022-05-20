require('./bootstrap');

import Vue from 'vue'
import axios from 'axios'
import Vuetify from './plugins/vuetify'
import router from "./router";
import store from "./store"
import App from "./App.vue"

const app = new Vue({
    vuetify: Vuetify,
    router,
    store,
    render: (h) => h(App),
}).$mount('#app');