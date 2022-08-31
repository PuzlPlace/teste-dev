<template>
    <div class="h-100 container">
        <div class="row mt-5">
            <div class="col">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><router-link to="dashboard">Dashboard</router-link></li>
                        <li class="breadcrumb-item" aria-current="page">Livros</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ form.code == null ? 'Novo livro' : 'Edição de livro' }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <ErrorAlerts ref="errorAlerts"></ErrorAlerts>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ form.code == null ? 'Cadastre um novo livro' : `Alteração do livro ${form.name}` }}</h5>
                        <div class="row">
                            <div class="col">
                                <form @submit.prevent.stop="saveBook" novalidate>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="name" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="name" placeholder="Nome..." v-model="form.name"
                                                   maxlength="60">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="title" class="form-label">Autor</label>
                                            <input type="text" class="form-control" id="author" placeholder="Autor..." v-model="form.author"
                                                   maxlength="256">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="category" class="form-label">Categoria</label>
                                            <select class="form-select" id="category"
                                                    v-model.number="form.categories_id">
                                                <option value="0" disabled>Selecione uma categoria</option>
                                                <option v-for="(category, category_i) in form.categories"
                                                        :key="category_i"
                                                        :value="category.id">{{ category.name }}</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="file_type" class="form-label">Tipo de Arquivo</label>
                                            <select class="form-select" id="file_type" v-model="form.file_type">
                                                <option value="0" disabled>Selecione um tipo de arquivo</option>
                                                <option value="digital_file">Digital</option>
                                                <option value="physical_file">Físico</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3" v-if="form.file_type !== '0'">
                                        <div class="col">
                                            <div class="input-group">

                                                <input type="number"
                                                       min="0"
                                                       id="size_or_weight"
                                                       class="form-control"
                                                       v-model="form.size_or_weight"
                                                       :placeholder="form.file_type === 'digital_file' ? 'Tamanho do arquivo' : 'Peso do livro'"
                                                       :aria-label="form.file_type === 'digital_file' ? 'Tamanho do arquivo' : 'Peso do livro'"
                                                       aria-describedby="basic-addon2">
                                                <span class="input-group-text" id="basic-addon2">{{ size_type }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" :class="{'disabled' : form.sending}" class="btn btn-primary">Salvar</button>
                                        &nbsp;
                                        <button type="button" :class="{'disabled' : form.sending}" class="btn btn-danger" @click="cancelOperation">Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import bookManager from "@/services/bookManager";
import Swal from "sweetalert2";
import router from "@/router";
import ErrorAlerts from "@/components/default/ErrorAlerts";

export default {
    name: "CreateOrEdit",
    components: {ErrorAlerts},
    data() {
        return {
            form: {
                categories: [],

                code: null,
                name: null,
                author: null,
                categories_id: 0,
                size_or_weight: null,
                file_type: '0',

                sending: false,
            },

            size_type: null,
        }
    },
    watch: {
        'form.file_type'(newValue) {
            if(newValue === 'digital_file')
                this.size_type = 'MB';
            else if(newValue === 'physical_file')
                this.size_type = 'KG';
        }
    },
    methods: {
        cancelOperation(){
            router.back()
        },

        async findBookForUpdate(code){
            const book = await bookManager.findBookByCode(code)

            this.form.code = book.code
            this.form.name = book.name
            this.form.author = book.author
            this.form.categories_id = book.categories_id
            this.form.file_type = book.file_type
            this.form.size_or_weight = book.size_or_weight
        },

        async getCategoriesToSelect(){
            this.form.categories = await bookManager.getAllCategories()
        },

        async saveBook() {
            this.form.sending = true
            const payload = {
                name: this.form.name,
                author: this.form.author,
                categories_id: this.form.categories_id,
                size_or_weight: this.form.size_or_weight,
                file_type: this.form.file_type,
            }

            if(!this.form.code){
                await bookManager.createBook(payload)
                .then(() => {
                    router.push({ name: 'Books', params: { msg: 'Livro cadastrado com sucesso.' } })
                })
                .catch(error => {
                    // eslint-disable-next-line no-prototype-builtins
                    if(error.response.data.hasOwnProperty('validation_errors')){
                        this.$refs.errorAlerts.showMessages(error.response.data.validation_errors)
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops! Ocorreu um erro.',
                            text: error.response.message,
                            footer: '<b>' + error.response.exception + '</b>'
                        })
                    }
                }).finally(() => {
                    this.form.sending = false
                })
            }else{
                await bookManager.updateBook(payload, this.form.code)
                .then(() => {
                    router.push({ name: 'Books', params: { msg: 'Livro alterado com sucesso.' } })
                })
                .catch(error => {
                    // eslint-disable-next-line no-prototype-builtins
                    if(error.response.data.hasOwnProperty('validation_errors')){
                        this.$refs.errorAlerts.showMessages(error.response.data.validation_errors)
                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops! Ocorreu um erro.',
                            text: error.response.message,
                            footer: '<b>' + error.response.exception + '</b>'
                        })
                    }
                }).finally(() => {
                    this.form.sending = false
                })
            }
        }
    },

    mounted() {
        this.getCategoriesToSelect()

        // eslint-disable-next-line no-prototype-builtins
        if(this.$route.params.hasOwnProperty('bookEditId'))
            this.findBookForUpdate(this.$route.params.bookEditId)
    }
}
</script>

<style scoped>

</style>
