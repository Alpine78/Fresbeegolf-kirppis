<template>
  <div>
    {{ adverts }}
  </div>
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
