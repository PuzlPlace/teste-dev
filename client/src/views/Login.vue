<template>
    <div class="h-100 d-flex align-items-center">


        <div class="form-signin w-100 m-auto">
            <ErrorAlerts class="mb-2" ref="errorAlerts"></ErrorAlerts>

            <form @submit.prevent.stop="signIn">
                <h1 class="h3 mb-3 fw-normal">Login</h1>

                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="form.email">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="form.password">
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary"
                        :disabled="form.sending"
                        type="submit">Sign in</button>
            </form>
        </div>
    </div>
</template>

<script>


import authManager from "@/services/authManager";
import ErrorAlerts from "@/components/default/ErrorAlerts";
import Cookies from 'js-cookie'
import router from "@/router";

export default {
    name: "Login",
    components: {ErrorAlerts},
    data() {
        return {
            form: {
                email: null,
                password: null,
                sending: false,
            }
        }
    },
    methods: {
        async signIn() {
            this.$refs.errorAlerts.dismissed()
            const payload = this.form

            await authManager.login(payload)
            .then(response => {
                Cookies.set(process.env.VUE_APP_COOKIE_NAME, response.data.data.access_token)
                Cookies.set(process.env.VUE_APP_COOKIE_EXPIRE_NAME, response.data.data.expires_in)

                this.$store.commit('saveUserLogged', response.data.data.user)

                router.push('/dashboard')
            }).catch(error => {
                console.log(error)

                const response = error.response.data

                // eslint-disable-next-line no-prototype-builtins
                const errors = response.hasOwnProperty('validation_errors') ? response.validation_errors : (response.hasOwnProperty('exception') ? response.exception : null)

                this.$refs.errorAlerts.showMessages(errors)

                this.form.sending = false
            });
        }
    },
}
</script>

<style scoped>

body {
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
}

.form-signin {
    max-width: 50vw;
    padding: 15px;
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
