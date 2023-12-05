//Aqui vai conter as ações para chamar a API
import axios from "axios";

export default {
  async fetchLivros({ commit }) {
    try {
      const response = await axios.get(
        "http://localhost:3000/api/bibliotecaRouter"
      );
      commit("SET_LIVROS", response.data);
    } catch (error) {
      console.error("Erro ao obter os livros:", error);
    }
  },

  async criarLivro({ dispatch }, novoLivro) {
    try {
      await axios.post("http://localhost:3000/api/bibliotecaRouter", novoLivro);
      dispatch("fetchLivros");
    } catch (error) {
      console.error("Erro ao adicionar o livro:", error);
    }
  },
};
