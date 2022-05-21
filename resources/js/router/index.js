import Vue from 'vue'
import Main from '../views-vue/Main.vue'
import Login from '../views-vue/Login.vue'
import Register from '../views-vue/Register.vue'
import Profile from '../views-vue/Profile.vue'
import VueRouter from 'vue-router'
import store from "../store"

Vue.use(VueRouter);

const routes = [{
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
{
    path: '/profile',
    name: 'Profile',
    component: Profile,
    beforeEnter: (to, from, next) => {
        store.dispatch("checkAuth").then((result) => {
            result ? next("/profile") : next();
        });
    },
},
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

export default router;