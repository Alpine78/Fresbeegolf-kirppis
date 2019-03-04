<template>
    <div class="row justify-content-center pt-4">
        <div>
            <h1>Rekisteröidy</h1>
            <form action="#" @submit.prevent="register">
                <div class="form-group">
                    <label for="name">Etu- ja Sukunimi</label>
                    <input type="text" id="name" name="name" class="form-control" v-model="name">
                </div>
                <div class="form-group">
                    <label for="email">Sähköposti</label>
                    <input type="text" id="email" name="email" class="form-control" v-model="email">
                </div>
                <div class="form-group">
                    <label for="password">Salasana</label>
                    <input type="password" id="password" name="password" class="form-control" v-model="password">
                </div>
                <div class="form-group">
                    <label for="password-confirmation">Vahvista salasana</label>
                    <input type="password" id="password-confirmation" name="password-confirmation" class="form-control" v-model="passwordConfirmation">
                </div>
                <button type="submit" class="btn btn-primary">Rekisteröidy</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Register",
        data(){
            return{
                name: "",
                email: "",
                password: "",
                passwordConfirmation: "",
            }
        },
        methods: {
            register(){
                this.$store.dispatch('register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    passwordConfirmation: this.passwordConfirmation,
                }).then(response => {
                    this.$router.push({name: 'login'})
                })

            }
        }
    }
</script>

<style>

</style>