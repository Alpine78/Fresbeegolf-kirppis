<template>
    <div class="row pt-4 justify-content-center">
        <b-alert show variant="info w-50">
            <h1>Rekisteröidy</h1>
            <div v-if="serverErrors">
                <b-alert v-for="(value, key) in serverErrors" :key="key" show variant="danger">{{ value[0] }}</b-alert>
            </div>



            <form action="#" @submit.prevent="register">
                <div class="form-group">
                    <label for="firstname">Etunimi</label>
                    <input type="text" id="firstname" name="firstname" class="form-control" v-model="firstname">
                </div>
                <div class="form-group">
                    <label for="lastname">Sukunimi</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" v-model="lastname">
                </div>
                <div class="form-group">
                    <label for="lastname">Käyttäjätunnus</label>
                    <input type="text" id="nickname" name="nickname" class="form-control" v-model="nickname">
                </div>
                <div class="form-group">
                    <label for="email">Sähköposti</label>
                    <input type="text" id="email" name="email" class="form-control" v-model="email">
                </div>
                <div class="form-group">
                    <label for="password">Salasana</label>
                    <input type="password" id="password" name="password" class="form-control" v-model="password">
                    <b-form-text id="passwordHelpBlock">
                       Salasanan täytyy olla vähintään 8-merkkiä.
                    </b-form-text>
                </div>
                <div class="form-group">
                    <label for="password-confirmation">Vahvista salasana</label>
                    <input type="password" id="password-confirmation" name="password-confirmation" class="form-control" v-model="passwordConfirmation">
                </div>
                <button type="submit" class="btn btn-primary">Rekisteröidy</button>
            </form>
        </b-alert>
    </div>
</template>

<script>
    export default {
        name: "Register",
        data(){
            return{
                firstname: "",
                lastname: "",
                nickname: "",
                email: "",
                password: "",
                passwordConfirmation: "",
                serverErrors: "",
            }
        },
        methods: {
            register(){
                this.$store.dispatch('register', {
                    firstname: this.firstname,
                    lastname: this.lastname,
                    nickname: this.nickname,
                    email: this.email,
                    password: this.password,
                    passwordConfirmation: this.passwordConfirmation,
                }).then(response => {
                    this.$router.push({name: 'login', params: {msg: 'Rekisteröinti onnistui'}})
                }).catch(error =>{
                    this.serverErrors = Object.values(error.response.data.errors)
                    console.log(error.response.data.errors)
                })

            }
        }
    }
</script>

<style>

</style>