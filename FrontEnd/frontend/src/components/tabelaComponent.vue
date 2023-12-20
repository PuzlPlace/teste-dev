<template>
  <div class="container">
    <h1>Lista de Livros</h1>
    <div class="filtrarContainer">
      <form @submit.prevent="submitForm">
        <label id="label_categoria" for="category"
          >Filtrar por Categoria:</label
        >

        <select v-model="categoriaSelecionada">
          <option
            v-for="(category, index) in uniqueCategories"
            :key="index"
            :value="category"
          >
            {{ category }}
          </option>
        </select>
        <button class="filtrar-1 btn btn-primary" @click="filtrarCategoria">
          Filtrar
        </button>

        <label for="fileType">Filtrar por Tipo de Arquivo:</label>
        <select v-model="tipoSelecionado" id="fileType">
          <option value="Digital">Digital</option>
          <option value="Físico">Físico</option>
        </select>
        <button class="filtrar-2 btn btn-primary" @click="filtrarportipo">
          Filtrar
        </button>

        <label for="bookName">Filtrar por Nome do Livro:</label>
        <input
          type="text"
          v-model="nomeSelecionado"
          id="bookName"
          placeholder=""
        />

        <button
          class="filtrar-3 btn btn-primary no-transition"
          @click="filtrarPorNome"
        >
          Filtrar
        </button>
      </form>
    </div>

    <div id="mainButton">
      <button
        class="limpar_Filtro btn btn-primary no-transition"
        @click="limparFiltros"
      >
        Limpar Filtro
      </button>

      <button
        class="relatorio btn btn-primary no-transition"
        @click="gerarRelatorio"
      >
        Gerar Relatorio
      </button>
    </div>

    <div id="container">
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>Autor</th>
            <th>Categoria</th>
            <th>Tipo de arquivo</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(livro, index) in livrosFiltrados" :key="index">
            <td id="nome">
              <template v-if="!livro.editando">{{ livro.nome }}</template>
              <input v-else v-model="livro.nome" />
            </td>
            <td id="autor">
              <template v-if="!livro.editando">{{ livro.autor }}</template>
              <input v-else v-model="livro.autor" />
            </td>
            <td id="categoria">
              <template v-if="!livro.editando">{{ livro.categoria }}</template>
              <input v-else v-model="livro.categoria" />
            </td>
            <td>
              <template v-if="!livro.editando">{{ livro.tipo }}</template>
              <input v-else v-model="livro.tipo" />
            </td>
            <td>
              <button
                class=""
                v-if="!livro.editando"
                @click="editarlivro(livro._id)"
              >
                Editar
              </button>
              <button v-else @click="salvarlivro(livro)">Salvar</button>
              <button v-if="!livro.editando" @click="deletarlivro(livro._id)">
                Deletar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import ExcelJS from "exceljs";



export default {
  name: "tabelaComponent",
  /* eslint-disable */
  data() {
    return {
      categoriaSelecionada: "",
      nomeSelecionado: "",
      tipoSelecionado: "",
    };
  },
  computed: {
    livros() {
      return this.$store.getters.getUsers;
    },
    livrosFiltrados() {
      return this.$store.state.livrosFiltrados;
    },
    uniqueCategories() {
      const categories = this.livros.map((livro) => livro.categoria);
      return [...new Set(categories)].filter((category) => category);
    },
  },
  mounted() {
    this.$store.dispatch("fetchUsers").then(() => {
      this.$store.commit("RESETAR_FILTROS");
    });
  },
  methods: {
    async gerarRelatorio() {
      try {
        const response = await fetch(
          "http://localhost:3000/api/bibliotecaRouter"
        );
        if (response.ok) {
          const livros = this.livros;
          const workbook = new ExcelJS.Workbook();
          const worksheet = workbook.addWorksheet("Relatorio");

          livros.forEach((livro, index) => {
            const dataCriacao = new Date(livro.createdAt);
            const dataFormatada = new Date(dataCriacao.getTime() - (dataCriacao.getTimezoneOffset() * 60000))
            worksheet.addRow([
              livro._id,
              livro.nome,
              livro.autor,
              livro.categoria,
              livro.tipo,
              dataFormatada,
              livro.codigo,
              livro.tamanho,
            ]);
            const dataCell = worksheet.getCell(`F${index + 1}`);
            dataCell.numFmt = 'dd-mm-yyyy';
          });

          const styleHeader = {
            fill: {
              type: "pattern",
              pattern: "solid",
              fgColor: { argb: "475C6F" }, 
            },
            border: {
              top: { style: "thin" },
              left: { style: "thin" },
              bottom: { style: "thin" },
              right: { style: "thin" },
            },
          };

          const headers = [
            "ID",
            "Nome",
            "Autor",
            "Categoria",
            "Tipo",
            "Data de Criação",
            "Código",
            "Tamanho do Arquivo",
          ];

          //Loop pra colocar os nomes das colunas
          for (let i = 0; i < headers.length; i++) {
            worksheet.getCell(`${String.fromCharCode(65 + i)}1`).value =
              headers[i];
          }

          // Loop para definir cabeçalhos com estilo específico
          headers.forEach((header, index) => {
            worksheet.getCell(`${String.fromCharCode(65 + index)}1`).value =
              header;
            worksheet.getCell(`${String.fromCharCode(65 + index)}1`).fill =
              styleHeader.fill;
            worksheet.getCell(`${String.fromCharCode(65 + index)}1`).border =
              styleHeader.border;
          });
          // Aplicando bordas em todas as células preenchidas na planilha
          worksheet.eachRow((row) => {
            row.eachCell((cell) => {
              cell.border = {
                top: { style: "thin" },
                left: { style: "thin" },
                bottom: { style: "thin" },
                right: { style: "thin" },
              };
            });
          });
          // Aplicar filtro às células da tabela
          worksheet.autoFilter = `A1:H${livros.length + 1}`;

          const buffer = await workbook.xlsx.writeBuffer();
          const blob = new Blob([buffer], {
            type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
          });
          const arquivoExcel = URL.createObjectURL(blob);

          this.baixarArquivo(
            arquivoExcel,
            "relatorio.xlsx",
            "application/octet-stream"
          );
        } else {
          throw new Error("Erro ao buscar dados para o relatório");
        }
      } catch (error) {
        console.error("Erro ao gerar relatório:", error);
      }
    },
    baixarArquivo(dados, nomeDoArquivo, tipo) {
      const linkDeDownload = document.createElement("a");
      linkDeDownload.href = dados;
      linkDeDownload.download = nomeDoArquivo;
      linkDeDownload.target = "_blank";
      linkDeDownload.click();
    },
    ///função em branco pra prever erros ao submeter o formulario
    submitForm() {},
    filtrarCategoria() {
      if (!this.categoriaSelecionada.trim()) {
        alert("Por favor, selecione uma categoria antes de filtrar.");
        return;
      }
      this.$store.commit(
        "FILTRAR_LIVROS_POR_CATEGORIA",
        this.categoriaSelecionada
      );
    },
    limparFiltros() {
      this.categoriaSelecionada = "";
      this.nomeSelecionado = "";
      this.tipoSelecionado = "";
      this.$store.commit("RESETAR_FILTROS");
    },
    filtrarPorNome() {
      if (!this.nomeSelecionado.trim()) {
        alert("Por favor, digite um nome antes de filtrar.");
        return;
      } else {
        this.$store.commit("FILTRAR_LIVROS_POR_NOME", this.nomeSelecionado);
        if (this.livrosFiltrados.length === 0) {
          alert("Nenhum livro encontrado com esse nome.");
        }
      }
    },
    filtrarportipo() {
      if (!this.tipoSelecionado.trim()) {
        alert("Por favor, selecione um tipo antes de filtrar.");
        return;
      }
      this.$store.commit("FILTRAR_LIVROS_POR_TIPO", this.tipoSelecionado);
    },
    editarlivro(idLivro) {
      const livro = this.$store.getters.getUsers.find(
        (item) => item._id === idLivro
      );
      if (livro) {
        livro.livroEditando = { ...livro };
        livro.editando = true;
      }
    },

    async salvarlivro(livro) {
      try {
        const response = await fetch(
          `http://localhost:3000/api/bibliotecaRouter/${livro._id}`,
          {
            method: "PATCH",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              nome: livro.nome,
              autor: livro.autor,
              categoria: livro.categoria,
              tipo: livro.tipo,
            }),
          }
        );

        if (response.ok) {
          alert("Livro editado com sucesso!");
          livro.editando = false;
          this.atualizarLivroNoStore(livro);
        } else {
          throw new Error("Erro ao atualizar livro");
        }
      } catch (error) {
        console.error(error);
      }
    },

    async deletarlivro(idLivro) {
      try {
        var userid = this.$store.getters.getUsers;
        console.log(userid);

        var objetoEncontrado = userid.find((item) => item._id === idLivro);
        if (objetoEncontrado) {
          console.log("Existe", objetoEncontrado);
          const response = await fetch(
            `http://localhost:3000/api/bibliotecaRouter/${idLivro}`,
            {
              method: "DELETE",
            }
          );

          if (response.ok) {
            alert("Livro deletado com sucesso!");
          }
        } else {
          console.log("O idLivro não está presente na lista do usuário");
        }
      } catch (error) {
        console.error("Erro ao deletar o livro:", error);
      }
    },

    atualizarLivroNoStore(livroAtualizado) {
      //aqui esta vindo ja o array com o texto que eu digitei
      console.log(livroAtualizado);
      const index = this.$store.state.livrosFiltrados.findIndex(
        (livro) => livro._id === livroAtualizado._id
      );
      if (index !== -1) {
        this.$store.state.livrosFiltrados.splice(index, 1, livroAtualizado);
      }
    },
  },
};
</script>

<style scoped>
/*Mobile First*/
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

h1 {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  border-bottom: 1px solid grey;
}

form {
  margin-bottom: 20px;
}
label {
  display: block;
  margin-bottom: 6px;
  font-weight: bold;
  font-size: 17px;
}

#label_categoria {
  margin-top: 23px;
}

select {
  width: 100%;
  padding: 8px;
  margin-bottom: 12px;
  border-radius: 4px;
  border: 1px solid #cccccc;
}

input {
  width: 99%;
  padding: 8px;
  margin-bottom: 12px;
  border-radius: 4px;
  border: 1px solid #ccc;
}

.btn {
  width: 25%;
  background-color: black;
  padding: 5px;
}



.filtrarContainer {
  background-color: bisque;
  padding: 10px;
}

.btn-primary{
    border-color:black;
}


body .btn-primary:focus,
body .btn-primary:active {
  background-color: #1a1a1a;
  border-color: #1a1a1a;
}


.btn-primary:hover {
  background-color: #1a1a1a;
  border-color: #1a1a1a;
}



.filtrar-1 {
  margin-top: 20px;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
}

.filtrar-2 {
  margin-top: 20px;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
}

.filtrar-3 {
  margin-top: 20px;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
}

#mainButton {
  display: flex;
  justify-content: space-between;
  margin-top: 30px;
}

.limpar_Filtro {
  padding: 5px;
  width: 34%;
  height: 40px;
  font-size: 15px;
  display: flex;
  align-items: center;
}

.relatorio {
  padding: 5px;
  width: 42%;
  height: 40px;
  font-size: 16px;
  display: flex;
  align-items: center;
}

#container {
  overflow: auto;
  margin-top: 30px;
  border-radius: 12px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  margin-bottom: 12px;
}

table {
  width: 100%;
  border-collapse: collapse;
  background-color: #fff;
  border-radius: 12px;
}

button {
  display: flex;
  flex-direction: column;
  border-radius: 10px;
  background-color: black;
  color: #fff;
  margin-top: 5px;
}

table td {
  border: 1px solid #ccc;
  padding: 10px;
  text-align: left;
}

table th {
  background-color: #f2f2f2;
  border: 1px solid #ccc;
  padding: 8px;
  font-weight: bold;
}

/*Tablet CSS*/
@media only screen and (min-width: 768px) {
  select {
    display: flex;
    flex-direction: column;
    width: 300px;
  }
  input {
    display: flex;
    flex-direction: column;
    width: 100%;
    padding: 8px;
    margin-bottom: 12px;
    border-radius: 4px;
    border: 1px solid #ccc;
  }

  label {
    font-size: 19px;
  }

  .filtrarContainer {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: bisque;
    padding: 20px 5px 5px 5px;
  }

  .filtrar-1 {
    width: 50%;
    font-size: 19px;
  }



  .filtrar-2 {
    width: 50%;
    font-size: 19px;
  }

  .filtrar-3 {
    width: 50%;
    font-size: 19px;
  }

  .limpar_Filtro {
    padding: 5px;
    width: 34%;
    height: 40px;
    font-size: 19px;
    display: flex;
    align-items: center;
  }

  .relatorio {
    padding: 5px;
    width: 42%;
    height: 40px;
    font-size: 19px;
    display: flex;
    align-items: center;
  }

  th {
    font-size: 20px;
  }

  td {
    font-size: 20px;
  }
}

/*DESKTOP CSS*/

@media only screen and (min-width: 1024px) {
  select {
    width: 263px;
  }

  input{
    width: 100%;
  }

  label{
    font-size: 21px;
  }

  .limpar_Filtro {
    width: 25%;
    font-size: 21px;
    padding: 3px 0 3px 0;
  }

  .relatorio {
    width: 25%;
    font-size: 21px;
    padding: 3px 0 3px 0;
  }


}
</style>
