<template>
    <div>
        <h2 class="text-center mb-4">
            Listagem de Livros
        </h2>
        <div class="row p-3 mb-4 shadow border  p-3 mb-5 bg-body rounded ">
            <div class="col-12">
                <div class="row">
                    <div class="col-xxl-3 col-lg-3">
                        <div class="form-group">
                            <label>Categoria </label>
                            <select class="form-control" v-model="filter.category">
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xxl-3  col-lg-3">
                        <div class="form-group">
                            <label>Tipo </label>
                            <select class="form-control" v-model="filter.type">
                                <option value="digital">Digital</option>
                                <option value="physical">Físico</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xxl-4  col-lg-3">
                        <div class="form-group">
                            <label>Nome </label>
                            <input type="text" class="form-control" v-model="filter.name" required>
                        </div>
                    </div>
                    <div class="col-xxl-2  col-lg-3">
                        <div class="form-group">
                            <label> </label>
                            <button type="submit" class="btn btn-primary mt-4 w-full"
                                @click="getFilter()">Filtrar</button>
                            <button type="submit" class="btn btn-danger mt-4 w-full ms-2"
                                @click="clearFilter()">Limpar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Autor</th>
                        <th>Categoria</th>
                        <th>Tipo</th>
                        <th>Tamanho</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody v-if="books && books.length > 0">
                    <tr v-for="book in books" :key="book.id">
                        <td>{{ book.id }}</td>
                        <td>{{ book.code }}</td>
                        <td>{{ book.name }}</td>
                        <td>{{ book.author }}</td>
                        <td>{{ book.category }}</td>
                        <td>{{ book.type }}</td>
                        <td>{{ book.size }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <router-link :to="{ name: 'edit', params: { id: book.id } }" class="btn btn-success">
                                    Edit
                                </router-link>
                                <button class="btn btn-danger" @click="destroyBook(book.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td align="center" colspan="8">Nenhum registro encontrado.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pagination" style="display: flex;align-items: center;justify-content: space-between">
            <div style="display: flex;">
                <button class="btn btn-default" @click="list(pagination.prev_page_url)"
                    :disabled="!pagination.prev_page_url">
                    Anterior
                </button>
                <span style="display: flex;align-items: center;padding: 0 18px;opacity: 0.6;">
                    Página
                    {{ pagination.current_page }} de {{ pagination.last_page }}
                </span>
                <button class="btn btn-default" @click="list(pagination.next_page_url)"
                    :disabled="!pagination.next_page_url">Próximo
                </button>
            </div>

            <small>Total de Registros: {{ pagination.total }}</small>
        </div>
    </div>
</template>
 
<script>
// import pagination from 'laravel-vue-pagination'
export default {
    name: "books",

    data() {
        return {
            books: [],
            filter: {
                category: '',
                type: '',
                name: '',
            },
            pagination: []
        }
    },
    mounted() {
        this.list()
    },
    methods: {
        async list(page = `http://dev.test.lh/api/books?page=1`) {
            await axios.get(page).then(({ data }) => {
                this.books = data.data;
                this.pagination = {
                    prev_page_url: data.prev_page_url,
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    total: data.total
                };
            }).catch(({ response }) => {
                console.error(response)
            });
        },

        getFilter() {
            this.list(`http://dev.test.lh/api/books?page=1&category=${this.filter.category}&type=${this.filter.type}&name=${this.filter.name}`);
        },

        clearFilter() {
            this.list();
            this.filter = {
                category: '',
                type: '',
                name: '',
            };
        },

        destroyBook(id) {
            this.axios
                .delete(`http://dev.test.lh/api/books/${id}`)
                .then(response => {
                    let i = this.books.map(data => data.id).indexOf(id);
                    this.books.splice(i, 1)
                });
        }
    }
}
</script>
<style scoped>
.pagination {
    margin-bottom: 0;
}
</style>