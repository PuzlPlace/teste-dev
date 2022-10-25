<template>
    <div>
        <h2 class="text-center mb-4">
            Gerador de Relatório
        </h2>

        <form @submit.prevent="generateReport">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 shadow p-3 mb-5 bg-body rounded">
                    <div class="form-group row mb-4">
                        <label class="col-12" for="type">Categoria</label>
                        <div class="col-12">
                            <select class="form-control form-control-lg" id="type" v-model="report.category"
                                name="type">
                                <option value="all" selected>Todas</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-12" for="type">Tipo</label>
                        <div class="col-12">
                            <select class="form-control form-control-lg" id="type" v-model="report.type" name="type">
                                <option value="all" selected>Todas</option>
                                <option value="digital">Digital</option>
                                <option value="physical">Físico</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-12 ">
                            <strong>Intervalo de Datas</strong>
                        </div>
                        <div class="col-6 border-r">
                            <div class="input-group input-group-lg">
                                <input type="date" class="form-control bg-white" v-model="report.start_date"
                                    placeholder="00/00/0000">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-lg">
                                <input type="date" class="form-control bg-white" v-model="report.end_date"
                                    placeholder="00/00/0000">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-lg" style="width: 100%;">
                                Gerar Relatório
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div v-if="result && result.as_total" class="row mt-4">
            <div class="col-lg-6 offset-lg-3 shadow p-3 mb-5 bg-body rounded">
                <div
                    class="d-flex align-items-center p-3 my-1 text-white bg-primary bg-gradient bg-purple rounded shadow-sm">

                    <div class="lh-1">
                        <h1 class="h6 mb-0 text-white lh-1">Resultado do Relatório</h1>
                        <small></small>
                    </div>
                </div>
                <div class="row items-push text-center my-20">
                    <div class="col-md-4">
                        <div class="font-size-h3 font-w700">
                            {{result.as_total}}
                        </div>
                        <div class="text-muted font-w600 text-uppercase">Livros Cadastrados</div>
                    </div>
                    <div class="col-md-4">
                        <div class="font-size-h3 font-w700">
                            {{result.as_deleted}}
                        </div>
                        <div class="text-muted font-w600 text-uppercase">Livros Apagados</div>
                    </div>
                    <div class="col-md-4">
                        <div class="font-size-h3 font-w700">
                            {{result.as_non_deleted}}
                        </div>
                        <div class="text-muted font-w600 text-uppercase">Total de Ativos</div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else></div>
    </div>

</template>
        

<script>
export default {
    data() {
        return {
            report: {},
            result: {},
        }
    },
    methods: {
        generateReport() {
            this.axios
                .post('http://dev.test.lh/api/books/report', this.report)
                .then(response => {
                    console.log(response.data);
                    this.result = response.data;

                    // this.$router.push({ name: 'home', query: { response: response.data } })

                })
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>