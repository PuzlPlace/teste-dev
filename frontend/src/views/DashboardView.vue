<template>
  <div class="container">
    <div class="row">
        <div class="doughnut col-sm-12 col-md-6 ">
             <h1> Categorys</h1>
      <Doughnut />
        </div>
        <div class="doughnut col-sm-12 col-md-6" >
       <h1> By Date</h1>
      <Bar />
    </div>
    </div>
    
  </div>
</template>

<script>
import Doughnut from "../components/Doughnut.vue";
import Bar from "../components/Bar.vue";

export default ({
  components: { Doughnut, Bar },
  setup() {},
});
</script>
<style scoped>
.doughnut {
  text-align: center;
}
.container{
    margin-bottom: 20px;
}
</style>