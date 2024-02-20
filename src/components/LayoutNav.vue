<template>
    <hr>
    <ul class="nav flex-column">
        <div class="d-grid gap-2 mx-auto">
            <li class="nav-item">
                <router-link 
                    to="/"
                    class="btn btn-outline-success"
                    type="button"
                >
                    Livros
                </router-link>
            </li>
            <li class="nav-item">
                <router-link 
                    to="/dashboard"
                    class="btn btn-outline-success"
                    type="button"
                >
                    Dashboard
                </router-link>
            </li>
            <hr>
        </div>
    </ul>
    <add-book/>
</template>

<script>
import AddBook from './AddBook.vue'
import { ref } from 'vue'

export default {
    name: 'LayoutNav',

    components: {
        AddBook
    },
}


</script>

<style scoped>

</style>
