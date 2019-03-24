<template>
  <b-container>
    <search-result-item
      v-for="advert in adverts" :key="advert.id"
      :advert="advert"
     />
  </b-container>
</template>

<script>
export default {
  name: 'SearchResults',
  data: function() {
    return {
      adverts: []
    }
  },
  methods: {
  },
  mounted() {
    axios
    .get('ilmoitukset')
    .then(response => this.adverts = response.data.data);
  }
}
</script>

<style scoped>

</style>
