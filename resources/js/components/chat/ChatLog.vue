<template>
    <div class="chat-log" style="overflow-y: scroll; height:800px;" id="chat">
            <div v-for="(value, key) in messages[0]" :key="key">
            <chat-message :messages="value" :user1="messages[1]" :user2="messages[2]"></chat-message>
            </div>
    </div>
</template>

<script>
    export default {
        props: {
            messages: {
            }
        },
    }
</script>

<style scoped>

    .chat-log .chat-message:nth-child(even){
        background-color: #cccccc;
    }

</style>