<template>
    <div class="row justify-content-center pt-4">
        <div>
            <h1>Kirjaudu Sisään</h1>

            <form action="#" @submit.prevent="login">

                <div v-if="serverError">
                    <b-alert show variant="danger">{{ serverError }}</b-alert>
                </div>


                <div class="form-group">
                    <label for="username">Sähköposti</label>
                    <input type="text" id="username" name="username" class="form-control" v-model="username">
                </div>
                <div class="form-group">
                    <label for="password">Salasana</label>
                    <input type="password" id="password" name="password" class="form-control" v-model="password">
                </div>
                <button type="submit" class="btn btn-primary">Kirjaudu Sisään</button>
            </form>
            <p class="pt-2">Eikö sinulla ole vielä tunnusta?  <router-link :to="{ name: 'register' }"><a>Rekisteröidy ensin!</a></router-link></p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "login",
        data() {
            return{
                username: '',
                password: '',
                serverError: '',
            }
        },
        methods: {
            login(){
                this.$store.dispatch('retrieveToken', {
                    username: this.username,
                    password: this.password,
                }).then(response => {
                        this.$router.push({name: 'frontpage'})
                    })
                    .catch(error =>{
                        if(error.response.status == 401){
                            this.serverError = "Sähköposti tai salasana oli virheellinen, ole hyvä ja yritä uudelleen"
                            this.password = ''
                        } else if (error.response.status == 400) {
                            this.serverError = "Syötä sähköposti ja salasana"
                            this.password = ''
                        } else{
                            this.serverError = "Sisäänkirjautumisessa tapahtui virhe, ole hyvä ja yritä uudelleen"
                            this.password = ''
                        }
                        console.log(error.response)

                    })
            }
        }
    }
</script>

<style>

</style>