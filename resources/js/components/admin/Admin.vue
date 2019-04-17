<template>
    <div>
        <nav class="mt-2">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a v-if="admin || moderator" class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Moderointi</a>
            <a v-if="admin" class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Ylläpito</a>
        </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <h3>Moderaattorin työkalut</h3>
            <moderate-adverts></moderate-adverts>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <h3>Ylläpitäjän työkalut</h3>

        </div>
        </div>

    </div>
    
</template>

<script>
export default {
    name: 'Admin',
    data() {
        return {

        }
    },
    computed: {
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

</style>
