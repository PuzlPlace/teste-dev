<template>
    <div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">Filtro</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="category" class="form-label">Categoria</label>
                        <select class="form-select" id="category"
                                v-model.number="categorySelected">
                            <option value="0">Todos</option>
                            <option v-for="(category, category_i) in categories"
                                    :key="category_i"
                                    :value="category.id">{{ category.name }}</option>
                        </select>
                    </div>

                    <div class="col">
                        <label for="file_type" class="form-label">Tipo de Arquivo</label>
                        <select class="form-select" id="file_type" v-model="fileTypeSelected">
                            <option value="0">Todos</option>
                            <option value="digital_file">Digital</option>
                            <option value="physical_file">Físico</option>
                        </select>
                    </div>

                    <div class="col">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" placeholder="Nome..."
                               v-model="nameSelected"
                               maxlength="60">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <button type="button" class="btn btn-primary" @click="searchBooks">Buscar</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
import bookManager from "@/services/bookManager";

export default {
    name: "FilterBooks",
    props: {
        pCategorySelected: {
            type: Number,
            default: 0,
        },

        pFileTypeSelected: {
            type: String,
            default: '0',
        },

        pNameSelected: {
            type: String,
            default: null,
        },
    },
    data() {
        return {
            categories: [],

            categorySelected: this.pCategorySelected,
            fileTypeSelected: this.pFileTypeSelected,
            nameSelected: this.pNameSelected,
        }
    },
    watch: {
        pCategorySelected(newValue) {
            this.categorySelected = newValue
        },

        categorySelected(newValue){
            this.$emit('update:pCategorySelected', newValue)
        },

        pFileTypeSelected(newValue) {
            this.fileTypeSelected = newValue
        },

        fileTypeSelected(newValue){
            this.$emit('update:pFileTypeSelected', newValue)
        },

        pNameSelected(newValue) {
            this.nameSelected = newValue
        },

        nameSelected(newValue){
            this.$emit('update:pNameSelected', newValue)
        },
    },
    methods: {
        async getCategoriesToSelect(){
            this.categories = await bookManager.getAllCategories()
        },

        searchBooks() {
            this.$emit('searchBooks')
        }

    },
    mounted() {
        this.getCategoriesToSelect()
    }
}
</script>

<style scoped>

</style>
