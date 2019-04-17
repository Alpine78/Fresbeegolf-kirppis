<template>
  <div>

    <h1>Keskustelu</h1>
    <chat-log :messages="this.messages"></chat-log>
    <chat-composer :userToId="this.id"></chat-composer>
  </div>


</template>

<script>
  export default {
    created() {
      this.id = this.$route.params.userId;
      //haetaan viestit
      this.fetchMessages();

      Echo.channel('chatroom')
              .listen('MessagePosted', (e) => {
                this.fetchMessages();
              })
    },
    data() {
      return{
        id: 0,
        messages: [],
      }
    },
    methods: {
      fetchMessages() {
        this.$store.dispatch('fetchMessages', {
          user2: this.id,
           })
                .then(response =>{
                  this.messages = response.data;
                })
                .catch(error =>{
                  console.log(error);
                })
            }
    }
  }

</script>

<style scoped>

</style>
