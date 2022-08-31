<template>
    <div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Lista de usuários</h5>

                <div class="row">
                    <div class="col">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Data de Cadastro</th>
                            </tr>
                            </thead>
                            <tbody class="table-group-divider">
                            <tr v-for="(user, user_i) in users" :key="user_i">
                                <th scope="row">{{ (user_i + 1) }}</th>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.registration_date }}</td>
                                <td>
                                    <button class="btn btn-dark" title="Edit" aria-label="Edit"
                                            @click="editUser(user)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </button>
                                    &nbsp;
                                    <button type="button" class="btn btn-danger" title="Remove" aria-label="Remove"
                                            @click="deleteUser(user.uuid)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
import userManager from "@/services/userManager";
import Swal from "sweetalert2";

export default {
    name: "ListAllUsers",
    data() {
        return {
            users: []
        }
    },
    computed: {
        listAllUsers() {
            return this.users
        }
    },
    methods: {
        async getAllUsers() {
            try {
                this.users = await userManager.getAllUsers()
            }catch (e) {
                console.log(e)
            }
        },
        async deleteUser(id){
            Swal.fire({
                title: 'Você confirma a exclusão?',
                text: "Essa operação não poderá ser revertida!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim!',
                cancelButtonText: 'Cancelar.'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    await userManager.deleteUser(id).then(() => {
                        Swal.fire(
                            'Sucesso!',
                            'Usuário excluído com sucesso.',
                            'success'
                        )

                        this.getAllUsers()
                    }).catch(error => {
                        // eslint-disable-next-line no-prototype-builtins
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops! Ocorreu um erro.',
                            text: error.response.message,
                            footer: '<b>' + error.response.exception + '</b>'
                        })
                    })

                }
            })
        },
        async editUser(user){
            this.$emit('editUser', user)
        },

    },
    mounted() {
        this.getAllUsers()
    }
}
</script>

<style scoped>

</style>
