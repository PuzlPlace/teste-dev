<template>
    <div>
        <img src="../assets/img-organizar-tarefas.jpg" class="img-fluid" style="max-height: 100px; max-width: 100px;" alt="...">

        <div class="card text-center">
            <div class="card-header">
                ITasks
            </div>
            <div class="card-body">
                <h5 class="card-title">Administre suas tarefas com facilidade</h5>
                <p class="card-text">Cadastre novos usuários, crie e edite tarefas para usuários específicos e tenha maior controle do que seus usuários estão fazendo na palma da sua mão.</p>
                <router-link to="login" class="btn btn-primary">Vamos!</router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'HelloWorld',
  props: {
    msg: String
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
