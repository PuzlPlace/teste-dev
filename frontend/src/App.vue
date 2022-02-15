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
import Navbar from "../src/components/Navbar.vue";
import Footer from "../src/components/Footer.vue";

export default {
  setup() {
    return {};
  },
  components: {
    Navbar,
    Footer,
  },
};
</script>

<style>
body{ min-height:100vh; margin:0; position:relative;   background-color: #fff;
 }
header{ min-height:50px; }
body::after {
  content: '';
  display: block;
  height: 50px; /* Set same as footer's height */
}


</style>