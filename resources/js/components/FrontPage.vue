<template>
    <b-container>
        <p>TERVE</p>
        <b-link :to="{ name: 'demoadvert'}">
        <search-result-item></search-result-item>
        </b-link>
        <search-results></search-results>
    </b-container>
</template>

<script>
    export default {
        name: "FrontPage",
        components: {
        }
    }
</script>

<style scoped>

</style>