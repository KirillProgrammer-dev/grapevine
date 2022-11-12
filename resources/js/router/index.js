import Vue from 'vue'
import Main from '../views-vue/Main.vue'
import VueRouter from 'vue-router'
import store from "../store"

Vue.use(VueRouter);

const routes = [
{
    path: '/',
    name: 'Main',
    component: Main,
},
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

export default router;