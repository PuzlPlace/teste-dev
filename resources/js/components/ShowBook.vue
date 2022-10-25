<template>
    <div>
        <h3 class="text-center">Editar Livro</h3>
        <div class="row">
            <div class="col-md-12">
                <form @submit.prevent="updateBook">
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
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            book: {}
        }
    },
    created() {
        this.axios
            .get(`http://dev.test.lh/api/books/${this.$route.params.id}`)
            .then((res) => {
                this.book = res.data;
            });
    },
    methods: {
        updateBook() {
            this.axios
                .patch(`http://dev.test.lh/api/books/${this.$route.params.id}`, this.book)
                .then((res) => {
                    this.$router.push({ name: 'home' });
                });
        }
    }
}
</script>