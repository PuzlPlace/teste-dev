<template id="main">
  <div class="form-container">
    <form @submit.prevent="createLivro">
      <div class="input-container">
        <label for="nome">Nome do Livro:</label>
        <input
          class="input form-control"
          type="text"
          id="nome"
          name="nome"
          v-model="nome"
          placeholder="Digite o nome do Livro"
        />
      </div>
      <div class="input-container">
        <label for="nome">Nome do Autor:</label>
        <input
          class="input form-control"
          type="text"
          id="autor"
          name="autor"
          v-model="autor"
          placeholder="Digite o Autor"
        />
      </div>
      <div class="input-container">
        <label for="categoria">Categoria:</label>
        <input
          class="input form-control"
          type="text"
          id="categroia"
          name="categoria"
          v-model="categoria"
          placeholder="Digite a categoria"
        />
      </div>
      <div class="input-container">
        <label for="tipo">Tipo de arquivo(Físico/Digital):</label>
        <select
          class="input form-control"
          id="tipo"
          name="tipo"
          v-model="tipo"
        >
          <option value="Digital">Digital</option>
          <option value="Físico">Físico</option>
        </select>
      </div>

      <div id="button">
        <button class="btn btn-primary btn-lg btn-dark" type="submit">
          Submit
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "FormComponent",
  data() {
    return {
      nome: null,
      autor: null,
      categoria: null,
      tipo: null,
      codigo: null,
      tamanho: null,
    };
  },
  watch: {
    // eslint-disable-next-line no-unused-vars
    tipo(novoValor) {
      if (novoValor !== null && novoValor.toLowerCase() === "digital") {
        // Gerar um tamanho para arquivo digital
        this.tamanho = this.gerarTamanhoDigital();
      } else if (novoValor !== null && novoValor.toLowerCase() === "fisico") {
        this.tamanho = this.gerarTamanhoFisico();
      }
    },
  },
  methods: {
    gerarTamanhoDigital() {
      const fileSize1 = Math.floor(Math.random() * 100) + 1;
      return `${fileSize1} MB`;
    },
    gerarTamanhoFisico() {
      const fileSize2 = (Math.random() * 1 + 0.5).toFixed(2);
      return `${fileSize2} kg`;
    },
    async createLivro() {
      try {
        if (!this.nome || !this.autor || !this.categoria || !this.tipo) {
          alert("Preencha todos os campos: nome, autor e categoria.");
          //interromper a execução do método createLivro()
          return;
        }
        const data = {
          nome: this.nome,
          autor: this.autor,
          categoria: this.categoria,
          tipo: this.tipo,
          tamanho: this.tamanho,
        };

        const response = await fetch(
          "http://localhost:3000/api/BibliotecaRouter",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
          }
        );

        if (response.ok) {
          alert("Livro criado com sucesso!");
          this.nome = null;
          this.autor = null;
          this.categoria = null;
          this.tipo = null;
          this.codigo = null;
        } else {
          throw new Error("Erro ao criar livro");
        }
      } catch (error) {
        console.error("Erro ao criar livro:", error);
      }
    },
  },
};
</script>

<style scoped>
.form-container {
  display: flex;
  justify-content: center;
  padding: 100px;
  background-color: bisque;
}

.input-container {
  font-size: 25px;
  width: 100%;
  margin-bottom: 12px;
  margin-top: 20px;
  margin-left: 10px;
}
.input {
  margin-top: 15px;
  padding: 10px;
  width: 100%;
  border-radius: 5px;
  border-color: black;
}
#button {
  display: flex;
  justify-content: center;
  width: 100%;
  margin-top: 20px;
}
</style>
