<template>
    <div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cadastre um novo usuário</h5>
                <ErrorAlerts ref="errorAlerts"></ErrorAlerts>

                <div class="row">
                    <div class="col">
                        <form @submit.prevent.stop="saveUser">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Zé das Couves" v-model="form.name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="name@example.com" v-model="form.email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="123456" v-model="form.password">
                            </div>
                            <div class="mb-3">
                                <button type="submit" :class="{'disabled' : form.sending}" class="btn btn-primary">Salvar</button>
                                &nbsp;
                                <button type="button" :class="{'disabled' : form.sending}" class="btn btn-danger" @click="clearFields">Limpar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import userManager from "@/services/userManager";
import Swal from 'sweetalert2';
import ErrorAlerts from "@/components/default/ErrorAlerts";

export default {
    name: "CreateOrUpdate",
    components: {ErrorAlerts},
    data() {
        return {
            form: {
                uuid: null,
                name: null,
                email: null,
                password: null,

                sending: false,
            }
        }
    },
    methods: {
        clearFields(){
            this.form.uuid = null
            this.form.name = null
            this.form.email = null
            this.form.password = null
        },
        editUser(uuid, name, email){
            this.form.uuid = uuid
            this.form.name = name
            this.form.email = email
        },
        async saveUser() {
            this.form.sending = true
            const payload = this.form

            if(!payload.uuid){
                await userManager.createUser(payload)
                .then(() => {
                    this.clearFields()

                    Swal.fire('Sucesso!', 'Usuário cadastrado com sucesso', 'success')

                    this.$emit('userSaved')
                })
                .catch(error => {
                    // eslint-disable-next-line no-prototype-builtins
                    if(error.response.data.hasOwnProperty('validation_errors')) {
                        this.$refs.errorAlerts.showMessages(error.response.data.validation_errors)
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops! Ocorreu um erro.',
                            text: error.response.message,
                            footer: '<b>' + error.response.exception + '</b>'
                        })
                    }
                }).finally(() => {
                    this.form.sending = false
                })
            }else{
                await userManager.updateUser(payload)
                .then(() => {
                    this.clearFields()

                    Swal.fire('Sucesso!', 'Usuário alterado com sucesso', 'success')

                    this.$emit('userSaved')
                })
                .catch(error => {
                    // eslint-disable-next-line no-prototype-builtins
                    if(error.response.data.hasOwnProperty('validation_errors')) {
                        this.$refs.errorAlerts.showMessages(error.response.data.validation_errors)
                    }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops! Ocorreu um erro.',
                                text: error.response.message,
                                footer: '<b>' + error.response.exception + '</b>'
                            })
                    }
                }).finally(() => {
                    this.form.sending = false
                })
            }
        }
    },
}
</script>

<style scoped>

</style>
