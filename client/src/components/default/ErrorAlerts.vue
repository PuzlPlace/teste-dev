<template>
    <div>

        <div class="alert alert-danger alert-dismissible fade show" v-if="typeof messages == 'string' && messages != null"
                 @dismissed="dismissed">
            <strong>Erro!</strong> {{ messages }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" @click="dismissed" aria-label="Close"></button>
        </div>

        <div v-else-if="Array.isArray(messages) && messages.length > 0" role="alert">
            <div class="alert alert-danger alert-dismissible fade show" v-for="(message, message_i) in messages"
                 :key="message_i">
                <strong>Erro!</strong> {{ message }}
                <button type="button" class="btn-close" @click="dismissed(message_i)" aria-label="Close"></button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ErrorAlerts",
    data() {
        return {
            messages: {
                type: String|Array,
                default: () => null
            },
        }
    },
    methods: {
        showMessages(messages){
            console.log(messages)

            this.messages = messages
        },
        dismissed(i = -1) {
            if(i < 0)
                this.messages = null
            else
                this.messages.splice(i, 1)
        },
    },

}
</script>

<style scoped>

</style>
