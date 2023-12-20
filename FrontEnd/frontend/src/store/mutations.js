//Possui as mutações para atualizar o estado do Vuex
export const mutations = {
  SET_LIVROS(state, livros) {
    state.livros = livros;
  },
  FILTRAR_LIVROS_POR_CATEGORIA(state, categoriaSelecionada) {
    
    state.livrosFiltrados = state.livros.filter(livro => livro.categoria === categoriaSelecionada);
  },
  RESETAR_FILTROS(state) {
    state.livrosFiltrados = state.livros; 
  },
  SET_LIVROS_FILTRADOS(state, livros){
    state.livrosFiltrados = livros; 
  },
  FILTRAR_LIVROS_POR_NOME(){
    // Verifique se o nome não está vazio
    if (nome.trim() !== ''){
      state.livrosFiltrados = state.livros.filter(livro =>livro.nome.toLowerCase().includes(nome.toLowerCase()));
    }else{
      alert("Favor Digitar um livro")
      state.livrosFiltrados = state.livros;
    }
  },  
  FILTRAR_LIVROS_POR_TIPO(state, tipoSelecionado){
    console.log('Valor selecionado para filtrar:', tipoSelecionado);
    state.livrosFiltrados = state.livros.filter(livro => {
      console.log('Valor de livro.tipo:', livro.tipo);
      return livro.tipo.toLowerCase() === tipoSelecionado.toLowerCase();
    });
    console.log('Livros filtrados por tipo:', state.livrosFiltrados);

  }
};
  