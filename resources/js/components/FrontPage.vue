<template>
    <div>
        <p>TERVE</p>
        <b-link :to="{ name: 'demoadvert'}">
        <search-result-item></search-result-item>
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