import { createStore } from 'vuex'
import usuarios from './modules/usuarios'
import contas from './modules/contas'
import { state, mutations } from './default'

const store = createStore({
  modules: {
    usuarios,
    contas,
  },
  state,
  mutations
})

export default store