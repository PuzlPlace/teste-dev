<template>
    <div>
        <h2 class="text-center">Adicionar Livro</h2>
        <div class="row">
            <div class="col-md-12 py-2 text-end">
                <small><code>Todos os campos com * são obrigatórios</code></small>
            </div>

            <form @submit.prevent="addBook" class="border p-4 shadow p-3 mb-5 bg-body rounded">
                <div class="row mb-3">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Código <code>*</code></label>
                            <input type="text" class="form-control" v-model="book.code" required>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Nome <code>*</code></label>
                            <input type="text" class="form-control" v-model="book.name" required>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Categoria <code>*</code></label>
                            <select v-model="book.category" class="form-control">
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tipo <code>*</code></label>
                            <select v-model="book.type" class="form-control">
                                <option value="digital">Digital</option>
                                <option value="physical">Físico</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Autor <code>*</code></label>
                            <input type="text" class="form-control" v-model="book.author" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tamanho <code>*</code></label>
                            <input type="text" class="form-control" v-model="book.size" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-4">Pronto</button>
            </form>

        </div>
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            book: {},
        }
    },
    methods: {
        addBook() {
            this.axios
                .post('http://dev.test.lh/api/books', this.book)
                .then(response => {
                    console.log(response.data);
                    this.$router.push({ name: 'home', query: { response: response.data } })

                })
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>