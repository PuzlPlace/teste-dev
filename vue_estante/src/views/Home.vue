<template>
  <div>
    <Navbar />
    <div class="m-5">
      <div class="alert alert-success" v-if="message != null" role="alert">
        {{ message }}
      </div>
      <div class="row">
        <div class="col-md-5">
          <p class="text-center text-success display-2">Cadastro</p>
          <InsertLivros />
        </div>
        <div class="col-md-7" style="max-width: 100%">
          <form action="" class="row" @submit.stop.prevent="listar">
            <div class="col-sm-12 col-md-3">
              <input type="text" class="form-control" v-model="nome" id="nome" placeholder="Nome"/>
            </div>
            <div class="col-sm-12 col-md-3">
              <select class="form-select" v-model="tipo" aria-label="Tipo de Arquivo">
                <option selected>Tipo de Arquivo</option>
                <option value="digital">Digital</option>
                <option value="fisico">Físico</option>
              </select>
            </div>
            <div class="col-sm-12 col-md-3">
              <select class="form-select" v-model="categoria" aria-label="Categoria">
                <option selected>Categoria</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="col-sm-12 col-md-3">
              <button class="btn btn-outline-dark">Pesquisar</button>
            </div>
          </form>
          <ListarLivros :list="livros" :message="message" />
        </div>
      </div>
      <div class="row">
        <ExibirLivro :livro="this.$store.getters.getLivroAtual" />
      </div>
    </div>
  </div>
</template>

<script>
//navbar
import Navbar from "./Components/NavBar.vue";
//itens
import InsertLivros from "./Components/Livros/InsertLivros.vue";
import ListarLivros from "./Components/Livros/ListarLivros.vue";
import ExibirLivro from "./Components/Livros/ExibirLivro.vue";
export default {
  name: "Home",
  data() {
    return {
      message: null,
      livro: null,
      categoria: "",
      nome: "",
      tipo:""
    };
  },
  components: {
    Navbar,
    InsertLivros,
    ListarLivros,
    ExibirLivro,
  },
  mounted() {
    this.$store.dispatch("setLivros");
  },
  watch: {
    message() {
      this.atribui();
    },
  },
  computed: {
    livros() {
      return this.$store.getters.getLivros;
    },
  },
  methods: {
    atribui() {
      this.message = this.$store.getters.getMessage;
    },
    listar(){
      const data = {
        "nome": this.nome,
        "tipo": this.tipo,
        "categoria" : this.categoria
      }
      this.$store.dispatch('setLivros', data)
    }
  },
};
</script>
