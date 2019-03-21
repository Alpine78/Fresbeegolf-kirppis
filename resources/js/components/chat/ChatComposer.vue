<template>
<div class="chat-composer">
    <b-form-input type="text" placeholder="Aloita kirjoittamaan viestisi..." v-model="messageText" @keydown.enter="sendMessage"></b-form-input>
    <b-button variant="outline-primary" @click="sendMessage">Lähetä</b-button>
</div>
</template>

<script>
    export default {

        data() {
            return {
                messageText: ""
            }
        },
        methods: {
            sendMessage() {
                this.$store.commit('pushMessage', { message: this.messageText, user: 'John doe'})
                this.messageText = "";
            }
        }
    }
</script>

<style scoped>

    .chat-composer {
        display: flex;
    }

    .chat-composer  input {
        flex: 1 auto;
    }
    .chat-composer button {
        border-radius: 0;
    }
</style>
