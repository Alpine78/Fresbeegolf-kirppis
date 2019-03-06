<template>
        <b-navbar toggleable="lg" type="light" variant="light">
          <b-navbar-brand class="link"><b-link :to="{ name: 'frontpage'}">FrisbeeGolf Kirppis</b-link></b-navbar-brand>

            <b-navbar-toggle target="nav_collapse" />

            <b-collapse is-nav id="nav_collapse">


                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto">
                    <b-navbar-nav>
                        <b-nav-item v-if="!loggedIn"><b-link :to="{ name: 'login'}">Kirjaudu sisään</b-link></b-nav-item>
                        <b-nav-item v-if="!loggedIn"><b-link :to="{ name: 'register'}">Rekisteröidy</b-link></b-nav-item>
                        <b-nav-item v-if="loggedIn"><b-link :to="{ name: 'logout'}">Kirjaudu ulos</b-link></b-nav-item>
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