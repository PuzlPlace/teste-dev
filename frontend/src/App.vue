<template>
  <div id="app">
    <header>
    <Navbar />
    </header>
    <main>
    <router-view />
    </main>
      <Footer />
  </div>
</template>
<script>
import Navbar from "../src/components/Navbar.vue"
import Footer from "../src/components/Footer.vue"


export default({
    setup() {
        return {

        }
    },
    components:{
      Navbar,
      Footer
    }
})
</script>

