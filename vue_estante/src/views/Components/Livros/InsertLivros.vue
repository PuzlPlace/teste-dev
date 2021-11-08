<template>
  <div class="row mt-4">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
      <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
          d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
        />
      </symbol>
      <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
          d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"
        />
      </symbol>
      <symbol
        id="exclamation-triangle-fill"
        fill="currentColor"
        viewBox="0 0 16 16"
      >
        <path
          d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
        />
      </symbol>
    </svg>
    <div class="alert alert-success d-flex align-items-center" role="alert" v-if="message != null">
      <svg
        class="bi flex-shrink-0 me-2"
        width="24"
        height="24"
        role="img"
        aria-label="Success:"
      >
        <use xlink:href="#check-circle-fill" />
      </svg>
      <div>{{ message }}</div>
    </div>
    <form action="" @submit.stop.prevent="insertLivro">
      <div class="input-group mb-3">
        <span class="input-group-text" id="Nome">Nome</span>
        <input
          type="text"
          class="form-control"
          aria-label="Nome"
          aria-describedby="Nome"
          v-model="nome"
        />
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="Autor">Autor</span>
        <input
          type="text"
          class="form-control"
          aria-label="Autor"
          aria-describedby="Autor"
          v-model="autor"
        />
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="Codigo">Código</span>
        <input
          type="text"
          class="form-control"
          aria-label="Codigo"
          aria-describedby="Codigo"
          v-model="codigo"
        />
      </div>
      <div class="input-group mb-3">
        <label class="input-group-text" for="Categorias">Categorias</label>
        <select class="form-select" id="Categorias" v-model="categoria">
          <option selected disabled>Escolha a categoria...</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
      <div class="input-group mb-3">
        <label class="input-group-text" for="Tipo">Tipo</label>
        <select class="form-select" id="Tipo" @change="observe($event)" v-model="tipo">
          <option selected disabled>Escolha o tipo...</option>
          <option value="fisico">Físico</option>
          <option value="digital">Digital</option>
        </select>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="Tamanho">Tamanho</span>
        <input
          type="text"
          class="form-control"
          aria-label="Tamanho"
          aria-describedby="Tamanho"
          v-model="tamanho"
        />
      </div>
      <button class="w-100 btn btn-lg btn-outline-success" type="submit">
        Cadastrar
      </button>
    </form>
  </div>
</template>
<script>
export default {
  name: "InsertLivros",
  data() {
    return {
      nome: "",
      autor: "",
      codigo: "",
      categoria: "",
      tipo: "",
      tamanho: "",
      message: null,
    };
  },
  watch:{
    tipo(){
      this.observe()
    }
  },
  methods: {
    insertLivro() {
      let data = {
        nome: this.nome,
        autor: this.autor,
        codigo: this.codigo,
        categoria: this.categoria,
        tipo: this.tipo,
        tamanho: this.tamanho,
      };
      this.$store.dispatch("insertLivro", data);
      this.message = this.$store.getters.insertLivro;
    },
    observe(event){
      alert(`Tipo selecionado: ${event.target.value}`)
    }
  },
};
</script>