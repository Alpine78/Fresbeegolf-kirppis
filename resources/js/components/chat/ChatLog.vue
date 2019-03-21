<template>
    <div class="chat-log">
        <chat-message v-for="(message,key) in messages" :key="key" :messages="message" ></chat-message>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                messages: this.$store.state.messages
            }
        },

    }
</script>

<style scoped>

    .chat-log .chat-message:nth-child(even){
        background-color: #cccccc;
    }
</style>