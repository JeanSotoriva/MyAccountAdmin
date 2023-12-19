import axios from 'axios'
import router from '@/router'
import Vue from 'vue';
import toast from '@/plugins/VueToastify';
import { TOKEN_NAME } from '@/configs/axios'
import { URI_BASE_API } from '@/configs/axios'

export default {

    state: {
        me: {
            id: '',
            username: '',
        },
        authenticated: false,
    },

    mutations: {
        SET_ME (state, me) {
            state.me = me
            state.authenticated = true
            console.log(state.authenticated )
        },

        SET_AUTHENTICATED (state, status) {
            state.authenticated = status
        },

        LOGOUT (state) {
            state.me = {
                id: '',
                username: '',
            }
            state.authenticated = false
        }
    },

    actions: {
        login ({ commit , dispatch}, params){
            return axios.post('/usuario/login', params)
            .then(response => {
                const token = response.data.data.token
                localStorage.setItem(TOKEN_NAME, token);
                dispatch('getMe')
            })
        },

        getMe ({ commit }) {
            const token = localStorage.getItem(TOKEN_NAME);
            if (!token) {
                return Promise.reject("Token não encontrado no localStorage");
            }
            return axios.get('/auth/me', {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => commit('SET_ME', response.data.data))
            .catch(error => {
                console.error("Erro ao obter os dados do usuário:", error);
                localStorage.removeItem(TOKEN_NAME);
                return Promise.reject(error);
            });
        },
        
        logout ({commit}, toast) {
            const token = localStorage.getItem(TOKEN_NAME)  
            if (!token) return;

            return axios.post('auth/logout', {}, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => {
                commit('LOGOUT')
                localStorage.removeItem(TOKEN_NAME)
                router.push({ name: 'login' })
            })
            .catch(error => {
                console.error("Erro ao deslogar:", error)
                router.push({ name: 'dashboard' })
            })
        }

    }
}