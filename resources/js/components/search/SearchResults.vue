<template>
<b-container>

  <b-card-group columns>
    <search-result-item
      v-for="advert in adverts" :key="advert.id"
      :advert="advert"
      :counter="advert.id"
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
      counter: 0
    }
  },
  methods: {
      filteredItems(column, columns) {
        const self = this; // Enables us to pass this to the method
        const total = this.adverts.length; // How many items
        const gap = Math.ceil(total / columns); // How many per col
        let top = (gap * column); // Top of the col
        const bottom = ((top - gap) + 1); // Bottom of the col
        top -= 1; // Adjust top back down one
        return self.adverts.filter(advert =>
            self.adverts.indexOf(advert) >= bottom
            && self.adverts.indexOf(advert) <= top,
        ); // Return the items for the given col
    },
  },
  computed: {

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
