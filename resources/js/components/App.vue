<template>
    <div class="container">
        <nav class=" navbar-dark bg-dark navbar navbar-expand-lg navbar-expand navbar-light bg-light mb-4">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link btn btn-sm btn-secondary ms-2 me-2">Listar
                        Livros</router-link>
                    <router-link to="/create" class="nav-item nav-link btn btn-sm btn-secondary">Adicionar Livro
                    </router-link>
                    <router-link to="/report" class="nav-item nav-link text-dark btn btn-sm btn-warning ms-2 me-2 ">
                        Relatório</router-link>
                </div>
            </div>
        </nav>
        <router-view v-slot="{ Component }">
            <suspense>
                <component :is="Component" />
            </suspense>
        </router-view>
    </div>
</template>
 
<script>
export default {}
</script>