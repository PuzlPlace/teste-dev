<template>
  <div class="container mt-5">
    <div class="row">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Autor</th>
            <th scope="col">Categoria</th>
            <th scope="col">Código</th>
            <th scope="col">Tipo</th>
            <th scope="col">Tamanho</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ livro.nome }}</td>
            <td>{{ livro.autor }}</td>
            <td>{{ livro.categoria }}</td>
            <td>{{ livro.codigo }}</td>
            <td>{{ livro.tipo }}</td>
            <td>{{ livro.tamanho }}</td>
            <td>
              <button
                type="button"
                class="btn btn-outline-warning"
                data-bs-toggle="modal"
                data-bs-target="#exampleModal"
              >
                Editar
              </button>
            </td>
            <td>
              <button
                type="button"
                class="btn btn-outline-danger"
                data-bs-toggle="modal"
                data-bs-target="#exampleModal2"
              >
                Excluir
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div
      v-if="livro != null"
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Alterar livro <span class="text-success">{{ livro.nome }}</span>
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form action="" @submit.stop.prevent="updateLivro">
              <div class="input-group mb-3">
                <span class="input-group-text" id="Nome">{{ livro.nome }}</span>
                <input
                  type="text"
                  class="form-control"
                  aria-label="Nome"
                  aria-describedby="Nome"
                  v-model="nome"
                />
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="Autor">{{
                  livro.autor
                }}</span>
                <input
                  type="text"
                  class="form-control"
                  aria-label="Autor"
                  aria-describedby="Autor"
                  v-model="autor"
                />
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="Codigo">{{
                  livro.codigo
                }}</span>
                <input
                  type="text"
                  class="form-control"
                  aria-label="Codigo"
                  aria-describedby="Codigo"
                  v-model="codigo"
                />
              </div>
              <div class="input-group mb-3">
                <label class="input-group-text" for="Categorias">{{
                  livro.categoria
                }}</label>
                <select class="form-select" id="Categorias" v-model="categoria">
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="input-group mb-3">
                <label class="input-group-text" for="Tipo">{{
                  livro.tipo
                }}</label>
                <select
                  class="form-select"
                  id="Tipo"
                  @change="observe($event)"
                  v-model="tipo"
                >
                  <option selected disabled>Escolha o tipo...</option>
                  <option value="fisico">Físico</option>
                  <option value="digital">Digital</option>
                </select>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="Tamanho">{{
                  livro.tamanho
                }}</span>
                <input
                  type="text"
                  class="form-control"
                  aria-label="Tamanho"
                  aria-describedby="Tamanho"
                  v-model="tamanho"
                />
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Fechar
                </button>
                <button type="submit" class="btn btn-primary">
                  Salvar alterações
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div
      v-if="livro != null"
      class="modal fade"
      id="exampleModal2"
      tabindex="-1"
      aria-labelledby="exampleModalLabel2"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Deletar livro <span class="text-success">{{ livro.nome }}?</span>
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Fechar
            </button>
            <button type="submit" @click.prevent="deletar(livro.id)" class="btn btn-danger">
              Confirmar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "ExibirLivro",
  data() {
    return {
      nome: "",
      autor: "",
      codigo: "",
      tamanho: "",
      categoria: "",
      tipo: "",
    };
  },
  props: {
    livro: null,
  },
  methods: {
    updateLivro() {
      let data = {
        nome: this.nome,
        autor: this.autor,
        codigo: this.codigo,
        categoria: this.categoria,
        tipo: this.tipo,
        tamanho: this.tamanho,
      };
      this.$store.dispatch("updateLivro", { id: this.livro.id, data: data });
    },
    observe(event) {
      alert(`Tipo selecionado: ${event.target.value}`);
    },
    deletar(id){
        this.$store.dispatch("deleteLivro", id);
    },
    watch: {
      tipo() {
        this.observe();
      },
    },
  },
};
</script>