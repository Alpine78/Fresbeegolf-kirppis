<template>
    <b-container>
        <p>TERVE {{ userdetails ? userdetails.firstname : 'kirjautumaton'}}</p>
        
        <!-- <b-link :to="{ name: 'demoadvert'}">
        <search-result-item></search-result-item>
        </b-link> -->
        <h3>Tässäpä uusimmat ilmoitukset</h3>
        <search-results></search-results>
    </b-container>
</template>

<script>
    export default {
        name: "FrontPage",
        components: {
        },
        methods: {
            getUserDetails() {
                this.$store.dispatch('fetchUserData');
            }
        },
        computed: {
            userdetails() {
                return this.$store.getters.userdetails;
            }
        },
        created() {
            this.getUserDetails();
        }
    }
</script>

<style scoped>

</style>