import axios from "axios"
import { URI_BASE_API } from '@/configs/axios'

export default {
    state: {
        contas: [],
        extratos: []
    },

    mutations: {
        SET_CONTAS(state, params){
            state.contas = params
        },
        SET_EXTRATO(state, params){
            state.extratos = params.data
        }
    },

    actions: {
        getContas ({ commit }) {
            commit('SET_PRELOADER', true)
            commit('SET_TEXT_PRELOADER', 'Carregando as contas')
          
            return axios.get(`${URI_BASE_API}/contas`) 
            .then(response => commit('SET_CONTAS', response.data))
            .finally(() => commit('SET_PRELOADER', false))
        },
        
        getMovimentacoes ({ commit }, params) {
            commit('SET_PRELOADER', true)
            commit('SET_TEXT_PRELOADER', 'Carregando as movimentações')
          
            return axios.get(`${URI_BASE_API}/contas/${params.conta}/extrato`) 
            .then(response => commit('SET_EXTRATO', response.data))
            .finally(() => commit('SET_PRELOADER', false))
        },
        
        deleteContas ({ commit }, params) {
            commit('SET_PRELOADER', true)
            commit('SET_TEXT_PRELOADER', 'deletando conta')
            
            return axios.delete(`${URI_BASE_API}/conta/${params.conta}`)
            .then(response => response.data)
            .finally(() => commit('SET_PRELOADER', false))
        },

        storeMovimentacoes({ commit }, params) {
            commit('SET_PRELOADER', true)
            commit('SET_TEXT_PRELOADER', 'Cadastrando Movimentação')
            return axios.post(`${URI_BASE_API}/movimentacao`, params) 
            .then(response => response.data)
            .catch(err => err.response.data)
            .finally(() => {
                commit('SET_PRELOADER', false)
            })
        },

        storeContas({ commit }, params) {
            commit('SET_PRELOADER', true)
            commit('SET_TEXT_PRELOADER', 'Cadastrando Conta')
            return axios.post(`${URI_BASE_API}/conta`, params) 
            .then(response => response.data)
            .catch(err => err.response.data)
            .finally(() => {
                commit('SET_PRELOADER', false)
            })
        },
    },

    getters: {

    }


}