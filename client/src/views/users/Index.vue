<template>
    <div class="h-100 container">
        <div class="row mt-5">
            <div class="col">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><router-link to="dashboard">Dashboard</router-link></li>
                        <li class="breadcrumb-item active" aria-current="page">Usuários</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mt-2 mb-3">
            <div class="col">
                <CreateOrUpdate ref="createOrUpdateUser" @userSaved="userSaved"></CreateOrUpdate>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <ListAllUsers ref="listAllUsers" @editUser="editUser"></ListAllUsers>
            </div>
        </div>

    </div>
</template>

<script>
import ListAllUsers from "@/components/users/ListAllUsers";
import CreateOrUpdate from "@/components/users/CreateOrUpdate";
export default {
    name: "Index",
    components: {CreateOrUpdate, ListAllUsers},
    methods: {
        userSaved() {
            this.$refs.listAllUsers.getAllUsers()
        },
        editUser(user){
            this.$refs.createOrUpdateUser.editUser(user.uuid, user.name, user.email)
        }
    },
}
</script>

<style scoped>

</style>
