<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <router-link to="/" class="navbar-brand">Estante de Livros</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="noLoggedMenu" v-if="!userIsLogged">
                    <li class="nav-item">
                        <router-link to="login" class="nav-link active" aria-current="page">Login</router-link>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="loggedMenu" v-else>
                    <li class="nav-item">
                        <router-link to="/dashboard" class="nav-link active" aria-current="page">Dashboard</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/users" class="nav-link active" aria-current="page">Usuários</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/books" class="nav-link active" aria-current="page">Livros</router-link>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ userNameLogged }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import authManager from "@/services/authManager";

export default {
    name: "Navigation",
    computed: {
        userIsLogged() {
            return this.$store.state.userLogged != null
        },
        userNameLogged() {
            return (authManager.userIsLogged() ? this.$store.state.userLogged.name : null)
        }
    },
}
</script>

<style scoped>

</style>
