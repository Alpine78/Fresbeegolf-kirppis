<template>
    <b-navbar toggleable="lg" type="light" variant="light">
        <b-navbar-brand class="link">
            <b-link :to="{ name: 'frontPage'}">FrisbeeGolf Kirppis</b-link>
        </b-navbar-brand>

        <b-navbar-toggle target="nav_collapse" />

        <b-collapse is-nav id="nav_collapse">

            <b-navbar-nav>
                <b-nav-item><b-link :to="{ name: 'ilmoitus'}">Omat ilmoitukset</b-link></b-nav-item>
                <b-nav-item v-if="moderator || admin"><b-link :to="{ name: 'admin'}">Ylläpito</b-link></b-nav-item>
            </b-navbar-nav>

            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">
                <b-navbar-nav>                    
                    <b-button :to="{ name: 'ilmoita'}" variant="outline-primary" class="mr-2">Jätä ilmoitus</b-button>
                    <search-bar></search-bar>
                    <b-nav-item v-if="!loggedIn"><b-link :to="{ name: 'login'}">Kirjaudu sisään</b-link></b-nav-item>
                    <b-nav-item v-if="!loggedIn"><b-link :to="{ name: 'register'}">Rekisteröidy</b-link></b-nav-item>
                    <b-nav-item v-if="loggedIn"><b-link :to="{ name: 'chat'}">Keskustelut</b-link></b-nav-item>
                    <b-nav-item v-if="loggedIn"><b-link :to="{ name: 'profile'}">Omat tiedot</b-link></b-nav-item>
                    <b-nav-item v-if="loggedIn"><b-link :to="{ name: 'signout'}">Kirjaudu ulos</b-link></b-nav-item>
                </b-navbar-nav>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</template>

<script>
    export default {
        name: "NavBar",
        computed: {
            loggedIn() {
                return this.$store.getters.loggedIn
            },
            userdetails() {
                return this.$store.getters.userdetails;
            },
            moderator() {
                return this.userdetails.role === 1;
            },       
            admin() {
                return this.userdetails.role === 2;
            }        
        }
    }
</script>

<style scoped>
    a{
        color:black;
    }
    a:hover{
        color:grey;
    }
</style>