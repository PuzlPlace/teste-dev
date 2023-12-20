import { createStore } from "vuex";
import axios from "axios";

export default createStore({
  state: {
    livros: [],
    livrosFiltrados: [],
  },
  mutations: {
    SET_USERS(state, data) {
      state.livros = data;
      console.log('Livros carregados:', state.livros);
    },
    FILTRAR_LIVROS_POR_CATEGORIA(state, categoriaSelecionada) {
      console.log("Categoria selecionada:", categoriaSelecionada);
      state.livrosFiltrados = state.livros.filter(
        (livro) => livro.categoria === categoriaSelecionada
      );
      console.log("Livros filtrados:", state.livrosFiltrados);
    },
    RESETAR_FILTROS(state) {
      state.livrosFiltrados = state.livros;
    },
    SET_LIVROS_FILTRADOS(state, livros) {
      state.livrosFiltrados = livros;
    },
    FILTRAR_LIVROS_POR_NOME(state, nomeLivro) {
      state.livrosFiltrados = state.livros.filter((livro) => livro.nome.toLowerCase().includes(nomeLivro.toLowerCase()));
    },
    FILTRAR_LIVROS_POR_TIPO(state,tipoSelecionado){
      console.log('Valor selecionado para filtrar:', tipoSelecionado);
      if (tipoSelecionado === ''){
        state.livrosFiltrados = state.livros;
      }else{
        state.livrosFiltrados = state.livros.filter((livro) => livro.tipo.toLowerCase() === tipoSelecionado.toLowerCase());
      }
      console.log('Livros filtrados por tipo:', state.livrosFiltrados);
    }
  },
  actions: {
    fetchUsers({ commit }) {
      return axios
        .get("http://localhost:3000/api/bibliotecaRouter")
        .then((response) => {
          console.log("Dados recebidos:", response.data);
          commit("SET_USERS", response.data);
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
  getters: {
    getUsers: (state) => state.livros,
    getLivrosFiltrados: (state) => state.livrosFiltrados,
  },
});
