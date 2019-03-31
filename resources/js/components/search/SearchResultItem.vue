<template>
    <b-card 
      :title="advert.title" 
      img-src="http://www.prodigydisc.eu/wp-content/uploads/2017/01/Prodigy-Disc-400-M3-green.png" 
      img-alt="Image" 
      img-top>
      <b-card-text>
        {{ advert.content }}
      </b-card-text>
      <b-button href="#" variant="primary">Näytä ilmoitus</b-button>
      <b-button @click="deleteAdvert(advert.id)" variant="danger">Poista</b-button>
      <div slot="footer"><small class="text-muted">Ilmoitus päivitetty {{ updated }}</small></div>
    </b-card>  
</template>

<script>
import moment from 'moment';
export default {
  name: 'SearchResultItem',
  props: {
    advert: {},
    counter: Number
  },
  computed: {
    updated() {
      // return 'test';
      moment.locale( "fi" );
      return moment(this.advert.updated_at).fromNow();
    }
  },
  methods: {
    deleteAdvert(id) {
      if (confirm('Haluatko varmasti poistaa ilmoituksen?')) {
        fetch(`api/ilmoitus/${id}`, {
          method: 'delete'
        })
        .then(res => res.json)
        .then(data => {
          alert('Ilmoitus poistettu!');
          this.$emit('refreshAdverts')
        })
        .catch(err => console.log(err));
      }
    }
  }
}
</script>

<style scoped>

</style>
