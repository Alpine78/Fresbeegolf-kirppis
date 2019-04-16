<template>

</template>

<script>
    export default{
        created(){
        this.$store.commit('setUserData', {});
        this.$store.dispatch('destroyToken')
            .then(response =>{
                this.$router.push({ name:'frontpage'})
            })
        }
    }
</script>