<template>
    <div class="home">
        <navbarComponent/>
        <tabelaComponent/>
    </div>
</template>

<script>
import navbarComponent from '@/components/navbarComponent.vue'
import tabelaComponent from '@/components/tabelaComponent.vue'

export default {
    name: "homeComponent",
    components: {
        navbarComponent,
        tabelaComponent
    }
}
</script>
