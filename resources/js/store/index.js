import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        // индикатор загрузки приложения
        isLoading: true,
        // токен для запросов
        token: localStorage.getItem("token"),
        // данные о пользователе
        user: null,
        //верность пароля
        isCorrect: true,
        //Услуги
        services: []
    },
    getters: {
        isLoggedIn(state) {
            return !!state.user;
        },
    },
    mutations: {
        setToken(state, payload) {
            state.token = payload.token;
            localStorage.setItem("token", payload.token);
        },
    },
    actions: {
        add_service(store, payload) {
            let token = store.state.token; 
            return axios.
                post("/api/add-services", {
                    title: payload.title,
                    description: payload.description,
                    deadline: payload.deadline,
                    min_price: payload.min_price,
                    max_price: payload.max_price,
                    token: token,
                }, {
                    headers: {
                        Authorization: "Bearer " + token,
                    }
                })
        },

        getToken(store, payload) {
            return axios
                .post("/api/token", {
                    email: payload.email,
                    password: payload.password,
                    device_name: navigator.userAgent,
                })
                .then((response) => {
                    if (response.status == 201) {
                        store.commit("setToken", { token: response.data });
                        window.location = "/";
                    } else {
                        store.state.isCorrect = false;
                    }
                }).catch(() => {
                    store.state.isCorrect = false;
                });
        },
        registration(store, payload) {
            return axios
                .post("/api/registration", {
                    name: payload.name,
                    email: payload.email,
                    password: payload.password,
                    class: payload.class,
                    skills: payload.skills,
                    describtion: payload.describtion,
                    device_name: navigator.userAgent,
                })
                .then((response) => {
                    store.commit("setToken", { token: response.data });
                    window.location = "/";
                });
        },
        checkAuth(store) {
            const token = store.state.token;
            if (token) {
                return true;
            } else {
                return false;
            }
            // const user = store.state.user;

            // if (!token) {
            //     store.state.isLoading = false;
            //     return false;
            // }

            // if (user) {
            //     store.state.isLoading = false;
            //     return true;
            // }

            // store.state.isLoading = true;
            return store
                .dispatch("getUser")
                .then(() => {
                    store.state.isLoading = false;
                    return true;
                })
                .catch(() => {
                    store.state.isLoading = false;
                    return false;
                });
        },

        logout(store) {
            const token = store.state.token;
            return axios
                .post("api/logout", null, {
                    headers: {
                        Authorization: "Bearer " + token,
                    },
                })
                .then((response) => {
                    store.commit("setToken", { token: "" });
                });
        },

        getUser(store) {
            const token = store.state.token;
            if (!token) {
                store.state.user = null;
                return;
            }

            return axios
                .get("api/user", {
                    headers: {
                        Authorization: "Bearer " + token,
                    },
                })
                .then((response) => {
                    store.state.user = response.data;
                });
        },

    },
});