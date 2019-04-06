<template>
    <b-container>
        <p>TERVE</p>
        <b-link :to="{ name: 'demoadvert'}">
        <search-result-item></search-result-item>
        <p>lorem*5</p>

        </b-link>
    </div>
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