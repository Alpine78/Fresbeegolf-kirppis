<template>
    <div>
        <h1 class="pt-4">Aloitetut Keskustelut</h1>
        <div class="pt-4" v-for="(value, key) in users" :key="key">
            <b-link :to="{ name: 'privateChat', params: {userId: value[1]}}">
                <b-button href="" block variant="success">
                    <h4>{{value[0]}}</h4>
                    <p>Paina jatkaaksesi keskustelua</p>
                </b-button>
            </b-link>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.$store.dispatch('fetchConversations')
                .then(response =>{
                    response.data.forEach(users =>{
                        if(users.length != 0){
                            this.users.push([users[0].nickname,users[0].id]);

                        }
                    });
                })
                .catch(error =>{
                 console.log(error);
            })
            this.id = this.$route.params.id;
        },
        data() {
            return{
                users: [],
                id: 0,
            }
        },
    }

</script>

<style scoped>


</style>