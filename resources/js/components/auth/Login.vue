<template>
    <div class="row justify-content-center pt-4">
        <div>
            <h1>Kirjaudu Sisään</h1>

            <form action="#" @submit.prevent="login">
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
            }
        }
    }
</script>

<style>

</style>