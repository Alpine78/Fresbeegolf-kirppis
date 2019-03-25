<template>
<b-container>
  <b-card-group v-for="advert in adverts" :key="advert.id" >
    <search-result-item
      :advert="advert"
      />

  </b-card-group>
  </b-container>
</template>

<script>
export default {
  name: 'SearchResults',
  data: function() {
    return {
      adverts: [],
      counter: 1
    }
  },
  methods: {
  },
  computed: {
    count() {
      this.counter++;
      console.log('rivi', this.counter);
      if (this.counter == 4) this.counter = 1;
      return this.counter;
    }
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
