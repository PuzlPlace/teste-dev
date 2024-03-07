<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Livros" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Livros</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-5 bg-white overflow-hidden shadow-sm sm:rounded-lg">  
                  <div class="m-5">
                      <div class="inline-block w-full">
                        <div class="m-2 w-full">
                            <label for="filtroNome">Filtrar por Nome:</label>
                            <input class="w-full" v-model="filtroNome" id="filtroNome" type="text">
                        </div>
                        <div class="m-2 w-full">
                            <label for="filtroAutor">Filtrar por Autor:</label>
                            <input class="w-full" v-model="filtroAutor" id="filtroAutor" type="text">
                        </div>
                        <div class="m-2 w-full">
                            <label for="filtroCategoria">Filtrar por Categoria:</label>
                            <input class="w-full" v-model="filtroCategoria" id="filtroCategoria" type="text">
                        </div>
                        <div class="m-2 w-full">
                            <label for="filtroTipo">Filtrar por Tipo:</label>
                            <select class="w-full" v-model="filtroTipo" id="filtroTipo">
                                <option value="">Todos</option>
                                <option value="Digital">Digital</option>
                                <option value="Físico">Físico</option>
                            </select>
                        </div>
                        <div class="m-2 w-full">
                          <button class="my-3 bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"  @click="limparFiltros()">Limpar filtros</button>
                        </div>
                      </div>
                    <div class="p-3 text-gray-900"><h2>Esses são os nosso livros:</h2></div>
                    <div class="m-3">
                      <ul>
                        <li v-for="(livro, index) in livrosFiltrados" :key="index">
                          {{ livro.nome }} - {{ livro.autor }} ({{ livro.tipo }}) - {{ livro.categoria }}
                            <Link :href="'/books/edit/'+livro.id">
                                <button class="m-3 bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                            </Link>
                        </li>
                      </ul>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      livros:[],
      filtroTipo: '',       
      filtroAutor: '',      
      filtroNome: '',       
      filtroCategoria: '',
    };
  },
  mounted() {
    this.carregarLivros();
  },
  computed: {
    livrosFiltrados() {
      return this.livros.filter(livro => {
        const tipoPassaFiltro = this.filtroTipo === '' || livro.tipo === this.filtroTipo;
        const autorPassaFiltro = this.filtroAutor === '' || livro.autor.toLowerCase().includes(this.filtroAutor.toLowerCase());
        const nomePassaFiltro = this.filtroNome === '' || livro.nome.toLowerCase().includes(this.filtroNome.toLowerCase());
        const categoriaPassaFiltro = this.filtroCategoria === '' || livro.categoria.toLowerCase().includes(this.filtroCategoria.toLowerCase());

        return tipoPassaFiltro && autorPassaFiltro && nomePassaFiltro && categoriaPassaFiltro;
      });
    },
  },
  methods: {
    carregarLivros() {
      axios.get(`/books`)
        .then(response => {
          this.livros = response.data;
        })
        .catch(error => {
          console.error('Erro ao carregar os livros:', error.response.data);
        });
    },
    limparFiltros() {
      this.filtroTipo = '';       
      this.filtroAutor = '';      
      this.filtroNome = '';       
      this.filtroCategoria = '';
    },
  },
};
</script>
