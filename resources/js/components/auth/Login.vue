<template>
    <div class="row justify-content-center pt-4">
        <b-alert show variant="info w-50">
            <div v-if="msg">
                 <b-alert variant="success" show> {{ msg }}</b-alert>
            </div>
            <div v-if="serverError">
                <b-alert show variant="danger">{{ serverError }}</b-alert>
            </div>

            <div>
            <h1>Kirjaudu Sisään</h1>
            <form action="#" @submit.prevent="login">


                <div class="form-group">
                    <label for="username">Sähköposti</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Syötä sähköposti" v-model="username">
                </div>
                <div class="form-group">
                    <label for="password">Salasana</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Syötä salasana" v-model="password">
                </div>
                <button type="submit" class="btn btn-primary">Kirjaudu Sisään</button>
            </form>
            <p class="pt-2">Eikö sinulla ole vielä tunnusta?  <router-link :to="{ name: 'register' }"><a>Rekisteröidy ensin!</a></router-link></p>
        </div>
        </b-alert>
    </div>
</template>

<script>
    export default {
        name: "login",
        created(){
            this.msg = this.$route.params.msg;
        },
        data() {
            return{
                username: '',
                password: '',
                serverError: '',
                msg: '',
            }
        },
        methods: {
            login(){
                this.$store.dispatch('retrieveToken', {
                    username: this.username,
                    password: this.password,
                }).then(response => {
                        this.$router.push({name: 'frontPage'})
                    })
                    .catch(error =>{
                        if(error.response.status == 401){
                            this.serverError = "Sähköposti tai salasana oli virheellinen, ole hyvä ja yritä uudelleen"
                            this.password = ''
                            this.msg =''
                        } else if (error.response.status == 400) {
                            this.serverError = "Syötä sähköposti ja salasana"
                            this.password = ''
                            this.msg =''
                        } else{
                            this.serverError = "Sisäänkirjautumisessa tapahtui virhe, ole hyvä ja yritä uudelleen"
                            this.password = ''
                            this.msg =''
                        }
                        console.log(error.response)

                    })
            }
        }
    }
</script>

<style>

</style>