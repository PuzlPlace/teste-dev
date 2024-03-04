<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Livros" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nossos livros</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Esses são os nosso livros:</div>
                        <ul>
                            <li v-for="livro in livros" :key="livro.id">
                                <strong>{{ livro.nome }}</strong> - {{ livro.autor }}
                                <p>Categoria: {{ livro.categoria }}</p>
                                <p>Código: {{ livro.codigo }}</p>
                                <p>Tipo: {{ livro.tipo }}</p>
                                <p>Tamanho: {{ livro.tamanho }} <span v-if="livro.tipo == 'Digital'">GB</span><span v-else>KG</span></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
  props: {
    livros: Array,
  },
};
</script>
