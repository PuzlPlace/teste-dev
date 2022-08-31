import { createStore } from 'vuex'

export default createStore({
  strict: true,
  state: {
    userLogged: null
  },
  mutations: {
    saveUserLogged(state, payload){
      state.userLogged = payload
    }
  },
  actions: {
  },
  getters: {

  },
  modules: {
  }
})
