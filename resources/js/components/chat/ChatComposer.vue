<template>
<div class="chat-composer">
    <b-form-input type="text" placeholder="Aloita kirjoittamaan viestisi..." v-model="messageText" @keydown.enter="sendMessage"></b-form-input>
    <b-button variant="outline-primary" @click="sendMessage">Lähetä</b-button>
</div>
</template>

<script>
    export default {
        props: {
            userToId: {},
        },
        data() {
            return{
                messageText: ""
            }
        },
        methods: {
            sendMessage: function() {
                this.$store.dispatch('sendMessage', {
                    content: this.messageText,
                    user2: this.$props.userToId,
                })
                    .then(response =>{

                    })
                    .catch(error =>{
                        console.log(error);
                    })
                this.messageText= "";
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
