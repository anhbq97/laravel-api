import { createStore } from 'vuex';
import axios from "axios";

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem('TOKEN')
        }
    },
    getters: {},
    actions: {
        login({ commit }, user) {
            axios.post("http://laravel.loc/api/login", {
                email: user.email,
                password: user.password,
            })
            .then((response) => {
                console.log(response)
                commit('setUser', response)
                
                return response;
            });
        },
        logout({ commit }, token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}` 
            axios.post("http://laravel.loc/api/logout", {
            })
            .then((response) => {
                console.log(response)
                commit('logout')
                return response;
            });
        }
    },
    mutations: {
        setUser: (state, userData) => {
            state.user.token = userData.data.data.access_token;
            state.user.data = {
                'email': 'bquocanh.97@gmail.com',
                'name': 'Bui Quoc Anh'
            };
            sessionStorage.setItem('TOKEN', userData.data.data.access_token);
        },
        logout: (state) => {
            state.user.token = null;
            state.user.data = {};
            sessionStorage.removeItem('TOKEN');
        }
    },
    modules: {}
})

export default store;