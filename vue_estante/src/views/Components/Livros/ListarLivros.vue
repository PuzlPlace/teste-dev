<template>
  <div class="mt-5">
    <div class="row">
      <table class="table table-hover table-responsive">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Autor</th>
            <th scope="col">Categoria</th>
            <th scope="col">Código</th>
          </tr>
        </thead>
        <tbody v-for="livro of list" :key="livro.id">
          <tr @click.prevent="consultaLivro(livro.id)" class="clickP">
            <td>{{ livro.nome }}</td>
            <td>{{ livro.autor }}</td>
            <td>{{ livro.categoria }}</td>
            <td>{{ livro.codigo }}</td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</template>
<script>
export default {
  name: "ListarLivros",
  props: {
    list: Array,
    message: String,
  },
  data(){
    return{
      filtros: null
    }
  },
  methods: {
    consultaLivro(id) {
      this.$store.dispatch("setLivroAtual", id);
    },
  }
};
</script>
<style scoped>
  .clickP{
    cursor: pointer;
  }
</style>