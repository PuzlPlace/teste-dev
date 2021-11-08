<template>
        
<main class="form-signin">
  <form @submit.stop.prevent="submit">
    <img class="mb-4" src="/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input v-model="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input v-model="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
  </form>
</main>
</template>
<script>
import axios from 'axios'
import Cookies from 'js-cookie'
import router from '../router/index'

export default {
    name: "Login",
    data(){
        return {
          user: null,
          email: '',
          password: ''
        }
    },
    methods: {
      submit () {
        axios.post('http://127.0.0.1:8000/api/login', {
          email: this.email,
          password: this.password
        })
        .then(res => {
          Cookies.set('_app_token',res.data.data.token.original.access_token, {expires: res.data.data.token.original.expires_in})
          Cookies.set('_app_user_name',res.data.data.user.name, {expires: res.data.data.token.original.expires_in})
          router.push("/")
        }).catch((error) => {
          console.log(error)
        })
      } 
    },
    created(){
      Cookies.remove('_app_token')
      Cookies.remove('_app_user_name')
    }
}
</script>
<style scoped>
html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>