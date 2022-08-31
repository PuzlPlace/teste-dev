<template>
    <div class="h-100 container">
        <div class="row mt-5">
            <div class="col">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><router-link to="dashboard">Dashboard</router-link></li>
                        <li class="breadcrumb-item active" aria-current="page">Livros</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <FilterBooks v-model:p-category-selected="categorySelected"
                             v-model:p-file-type-selected="fileTypeSelected"
                             v-model:p-name-selected="nameSelected"
                             @searchBooks="searchBooks"></FilterBooks>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <ListAllBooks ref="listAllBooks"></ListAllBooks>
            </div>
        </div>

    </div>

</template>

<script>

import ListAllBooks from "@/components/books/ListAllBooks";
import FilterBooks from "@/components/books/FilterBooks";

export default {
    name: "Index",
    components: {FilterBooks, ListAllBooks},
    data() {
        return {
            categorySelected: 0,
            fileTypeSelected: '0',
            nameSelected: null,
        }
    },
    methods: {
        searchBooks() {
            this.$refs.listAllBooks.filter.categorySelected = this.categorySelected
            this.$refs.listAllBooks.filter.fileTypeSelected = this.fileTypeSelected
            this.$refs.listAllBooks.filter.nameSelected = this.nameSelected
            this.$refs.listAllBooks.getAllBooks()
        }
    },

}
</script>

<style scoped>

</style>
