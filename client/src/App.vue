<template>
    <div id="page_template">
        <header>
            <Navigation></Navigation>
        </header>

        <main>
            <router-view/>
        </main>

        <footer>
            <div class="container">
                <h6>&copy; Desenvolvido por: Gabriel Angelo de Sousa Silva</h6>
            </div>
        </footer>

    </div>
</template>


<script>
import Navigation from "@/components/default/Navigation";
export default {
    components: {Navigation}
}
</script>

<style>
#page_template {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: auto;
}

header {

}

main {
    min-height: 85vh;
    margin-top: 5px;
}

footer {
    height: 50px;
}
</style>
