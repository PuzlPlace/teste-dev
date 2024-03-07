<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Livros" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar livro</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Edite os abaixo para alterar o livro.</div>
                    <div class="inline-block relative m-5">
                        <form @submit.prevent="editarLivro" class="w-full max-w-lg">
                          <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nome">Nome:</label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" v-model="book.nome" id="nome" type="text" required>
                                </div>
                                <div class="w-full px-3">
                                    <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="autor">Autor:</label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" v-model="book.autor" id="autor" type="text" required>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="categoria">Categoria:</label>
                                  <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" v-model="book.categoria" id="categoria" type="text" required>
                                </div>
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="codigo">Código (único):</label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" v-model="book.codigo" id="codigo" type="text" required>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3 mb-6">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="tipo">Tipo:</label>
                                    <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" v-model="book.tipo" id="tipo" required>
                                        <option value="Digital">Digital</option>
                                        <option value="Físico">Físico</option>
                                    </select>
                                </div>
                                <div class="w-full px-3 mb-6">
                                    <label v-if="book.tipo === 'Digital'" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="tamanho">Tamanho do Arquivo (GB):</label>
                                    <label v-if="book.tipo === 'Físico'" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="tamanho">Peso (KG):</label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" v-model="book.tamanho" id="tamanho" type="text" required>
                                </div>
                            </div>
                            <button type="submit" class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import axios from 'axios';
export default {
  props: {
    id: String,
  },
  data() {
    return {
      book: {
        nome: '',
        autor: '',
        categoria: '',
        codigo: '',
        tipo: '',
        tamanho: '',
      }
    };
  },
  mounted() {
    this.carregarLivro(this.id);
  },
  methods: {
    carregarLivro(id) {
      axios.get('/books/book/' + id)
        .then(response => {
          this.book = response.data;
        })
        .catch(error => {
          console.error('Erro ao carregar os livros:', error.response.data);
        });
    },
    editarLivro() {
      axios.put('/books/edit/' + this.id, this.book)
        .then(response => {
          alert('Livro atualizado com sucesso: ' + response.data.livro.nome);
          this.carregarLivro(this.id);
        })
        .catch(error => {
          alert('Erro ao atualizar o livro: ' + JSON.stringify(error.response.data.message));
          console.error('Erro ao atualizar o livro:', JSON.stringify(error.response.data));
        });
    },
    limparFormulario() {
      this.book = {
        nome: '',
        autor: '',
        categoria: '',
        codigo: '',
        tipo: '',
        tamanho: '',
      };
    },
  },
  watch: {
    'book.tipo'(novoValor, valorAntigo) {
      if (valorAntigo !== ''){
        console.log('Tipo alterado de', valorAntigo, 'para', novoValor);
      }
    },
  },
};
</script>