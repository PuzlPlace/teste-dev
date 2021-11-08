import Cookies from "js-cookie";
import Vue from "vue";
import Vuex from "vuex";
import axios from 'axios'
Vue.use(Vuex);
const url = 'http://localhost:8080'
const TOKEN = Cookies.get('_app_token')
const headers = {
  'Accept': 'application/json',
  'Content-Type': 'application/json',
  'Authorization': 'Bearer ' + TOKEN
}
export default new Vuex.Store({
  state: {
    livro: null,
    message: "",
    livroAtual: null,
    todosLivros: []
  },
  mutations: {
    setLivroAtual(state, payload) {
      state.livroAtual = payload;
    },
    setLivros(state, payload) {
      state.todosLivros = payload;
    },
    insertLivro(state, payload) {
      state.livro = payload
    },
    updateLivro(state, payload) {
      state.message = payload
    },
    deleteLivro(state, payload) {
      state.message = payload
    }
  },
  actions: {
    setLivroAtual(state, payload) {
      axios.create({
          baseURL: url,
          headers: headers
        })
        .get(url +"/"+ payload)
        .then((response) => {
          state.commit("setLivroAtual", response.data.data)
        })
    },
    setLivros(state, payload) {
      if(!payload){
        axios.create({
          headers: headers
        })
        .get(url+"/listar")
        .then((response) => {
          state.commit("setLivros", response.data.data)
        })
      }else if(payload.nome != "" || payload.tipo != "" || payload.categoria != ""){
        axios.create({
          headers: headers
        })
        .get(url+`/listar?nome=${payload.nome}&tipo=${payload.tipo}&categoria=${payload.categoria}`,)
        .then((response) => {
          state.commit("setLivros", response.data.data.data)

        })
      }else{
        axios.create({
          headers: headers
        })
        .get(url+"/listar")
        .then((response) => {
          state.commit("setLivros", response.data.data)
        })
      }
    },
    insertLivro(state, payload) {
      axios.create({
          headers: headers
        })
        .post(url+"/inserir", payload)
        .then((response) => {
          state.commit("insertLivro", response.data.message)
          alert(response.data.message)
        })
    },
    updateLivro(state, payload) {
      axios.create({
          headers: headers
        })
        .put(url+"/"+payload.id, payload.data)
        .then((response) => {
          state.commit("updateLivro", response.data.message)
          alert(response.data.message)
        }).catch((err)=>{
          console.log(err)
        })
    },
    deleteLivro(state, payload) {
      axios.create({
          headers: headers
        })
        .delete(url+"/"+payload)
        .then((response) => {
          state.commit("deleteLivro", response.data.message)
          alert(response.data.message)
        })
    }
  },
  modules: {},
  getters: {
    getLivroAtual: state => state.livroAtual,
    getLivros: state => state.todosLivros,
    insertLivro: state => state.livro,
    updateLivro: state => state.message,
    deleteLivro: state => state.message,
    getMessage: state => state.message,
  }
});