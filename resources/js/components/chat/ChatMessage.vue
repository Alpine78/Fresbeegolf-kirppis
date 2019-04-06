<template>
        <div class="pt-2">
          <div class="chat-message" v-bind:class="{ received: isReceived }" >
                      <p>{{messages.content}}</p>

                      <small class="name" v-if="isReceived">{{user2.nickname}}</small>
                      <small class="name" v-if="!isReceived">{{user1.nickname}}</small>
          </div>
        </div>
</template>

<script>
    export default {
        props: {
            messages: {
            },
            user1: {
            },
            user2: {

            }
        },
        computed: {
            isReceived: function() {
                if(this.$props.messages.user_id === this.$props.user1.id){
                    return false;
                }
                return true;
            }
        }
    }
</script>

<style lang="css">
    .chat-message {
        border-style: solid;
        border-width: 1px;
        padding: 1rem;
        font-size: 25px;
        word-break: break-all;
        width: 80%;
    }
    .chat-message {
        margin-bottom: .5rem;
        background-color: #cccccc;
    }
    .received {
        align: left;
        text-align: end;
        background-color: #8FBC8F;

    }
    .notReceived {
        background-color: #CCE5FF;

    }
    .name {
        font-size: 15px;
        text-decoration-color: #cccccc;
    }
    .srcoll {
        overflow-y: scroll;
    }
</style>
