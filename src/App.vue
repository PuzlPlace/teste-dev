<template>
  <div id="app">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-2 navigation-sidebar">
          <h1 class="app-title">
            Livros
          </h1>
          <layout-nav/>
        </div>
        <div class="col content">
          <router-view />
        </div>
      </div>
    </div>
  </div>
  
</template>

<script setup>
import LayoutNav from './components/LayoutNav.vue'

</script>

<style scoped>
#app {
  min-height: 100vh;
  color: black;
  background-color: rgb(198, 108, 108); 
}
.navigation-sidebar {
  width: 10rem;
  height: auto;
  background-color: rgb(255, 255, 255);
  margin: 0;
}
.app-title {
  font-size: 20pt;
  margin-top: 10px;
  text-align: center;
}
.content {
  flex-wrap: wrap;
  width: auto;
  height: 100hv;
}
</style>