<template>
  <div id="navContainer">
    <div id="nav">
      <router-link id="navHome" to="/">Home</router-link>
      <router-link id="navCriar" to="/criar">Criar</router-link>
    </div>
    
    <router-view></router-view>
  </div>
</template>

<style>
  #nav{
    
    border: 1px black solid;
    background-color: #475C6F;
    padding: 8px;
    display: flex;
    justify-content: center;

  }
  #navHome {
  text-decoration: none;
  margin-left: 30px;
  color: azure;
  padding: 30px;
  font-size: 23px;
  transition: color 0.3s;
}

#navHome:hover {
  color: #1a1a1a; 
}


#navCriar{
  text-decoration: none;
  margin-left: 40px;
  color: azure;
  padding: 33px;
  font-size: 23px;
}

#navCriar:hover {
  color: #1a1a1a; 
}

</style>
