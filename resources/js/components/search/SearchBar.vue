<template>
  <div>
    <b-nav-form  @submit.prevent="search"> 
      <b-form-input v-model="hakuteksti"  size="sm" class="mr-sm-2" type="text" placeholder="Haku" />
    </b-nav-form>
  </div>
</template>

<script>
export default {
  name: 'SearchBar',
  data() {
    return {
      hakuteksti: ''
    }
  },
  methods: {
    search(){
      console.log('Haetaan!');
      this.$router.push({ name:'haku', params: {hakuteksti: this.hakuteksti}});
      this.hakuteksti = '';
    }
  }
}
</script>

<style scoped>

</style>
