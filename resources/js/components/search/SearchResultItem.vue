<template>
    <b-card 
      :title="advert.title" 
      img-src="http://www.prodigydisc.eu/wp-content/uploads/2017/01/Prodigy-Disc-400-M3-green.png" 
      img-alt="Image" 
      img-top>
      <b-card-text>
        {{ advert.content }}
      </b-card-text>
      {{ counter }}
      <b-button href="#" variant="primary">Näytä ilmoitus</b-button>
      <div slot="footer"><small class="text-muted">Last updated 3 mins ago</small></div>
    </b-card>  
</template>

<script>
export default {
  name: 'SearchResultItem',
  props: {
    advert: {},
    counter: Number
  }
}
</script>

<style scoped>

</style>
