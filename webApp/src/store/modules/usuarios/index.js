import axios from "axios"
import { URI_BASE_API } from '@/configs/axios'

export default {
    state: {
        usuarios: [],
        user: {
            nome: '',
            cpf: '',
            data_nascimento: '',
        },
        endereco: {
            cep: '',
            rua: '',
            numero: '',
            cidade: '',
            estado: '',
        },
        is_edit: false,
    },

    mutations: {
        SET_USUARIOS(state, payload){
            state.usuarios = payload
        },
        DELETE_USUARIOS(state, params){
            state.usuarios = params
        },
        CLEAR_USER_INPUTS(state){
            state.user = {
                nome: '',
                cpf: '',
                data_nascimento: '',
            }
            state.endereco = {
                cep: '',
                rua: '',
                numero: '',
                cidade: '',
                estado: '',
            }
            state.is_edit = false
        },
        SET_EDIT_USER(state, params){
            state.user = params
            state.endereco = {
                cep: params.cep,
                rua: params.rua,
                numero: params.numero,
                cidade: params.cidade,
                estado: params.estado,
            }
            state.is_edit = true
        },
        SET_CEP_INPUT(state, params){
            console.log(params)
            state.endereco = {
                cep: params.data.cep,
                rua: params.data.rua,
                numero: params.data.numero,
                cidade: params.data.cidade,
                estado: params.data.estado,
            }
        }
    },

    actions: {

        storeEndereco({ commit, state }, data) {
            let body = state.endereco
            body['usuario_id'] = data.id
            return axios.post(`${URI_BASE_API}/endereco`, body) 
            .then(response => response.data)
            .catch(err => err.response.data)
            .finally(() => {
                commit('SET_PRELOADER', false)
                commit('CLEAR_USER_INPUTS')
            })
        },

        getUsuarios({ commit }) {
            commit('SET_PRELOADER', true)
            commit('SET_TEXT_PRELOADER', 'Carregando os usuarios')
            return axios.get(`${URI_BASE_API}/usuario`) 
            .then(response => commit('SET_USUARIOS', response.data))
            .catch(err => err.response.data)
            .finally(() => commit('SET_PRELOADER', false))
        },

        storeUsuarios({ commit , dispatch}, params) {
            commit('SET_PRELOADER', true)
            commit('SET_TEXT_PRELOADER', 'Cadastrando Pessoa')
            return axios.post(`${URI_BASE_API}/usuario`, params.user) 
            .then((response) => {
                if(response.data.success === true && params.endereco.cep){
                    dispatch('storeEndereco', response.data.data)
                }
                return response.data
            })
            .catch(err => err.response.data)
            .finally(() => {
                commit('SET_PRELOADER', false)
            })
        },

        editUsuarios({ commit }, params) {  
            commit('SET_PRELOADER', true)
            commit('SET_TEXT_PRELOADER', 'Cadastrando Pessoa')
            return axios.put(`${URI_BASE_API}/usuario`, params) 
            .then(response => response.data)
            .catch(err => err.response.data)
            .finally(() => {
                commit('SET_PRELOADER', false)
                commit('CLEAR_USER_INPUTS')
            })
        },
        
        deleteUsuarios ({ commit }, params) {
            return axios.delete(`${URI_BASE_API}/usuario/${params.cpf}`)
            .then(response => {
                commit('DELETE_USUARIOS', response.data)
                commit('SET_PRELOADER', false)
                return response.data
            })
            .catch(err => err.response.data)
            .finally(() => commit('SET_PRELOADER', false))
        },

        getCeps({ commit }, cep) {
            commit('SET_PRELOADER', true)
            commit('SET_TEXT_PRELOADER', 'Buscando Cep')
            return axios.get(`${URI_BASE_API}/cep/${cep}`) 
                .then(response => {
                    commit('SET_CEP_INPUT', response.data)
                    commit('SET_PRELOADER', false);
                    return response.data
                })
                .catch(err => err.response.data)
                .finally(() => commit('SET_PRELOADER', false))
        },

    },
    getters: {
        
    }

}