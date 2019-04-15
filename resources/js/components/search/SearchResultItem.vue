<template>
    <b-card 
      :title="advert.title" 
      :img-src="'/' + advert.photo" 
      img-alt="Kiekon kuva" 
      @click="showAdvert(advert.id)"
      :style="{ cursor: 'pointer'}"
      img-top>
      <b-card-text>
        {{ advert.content }}
      </b-card-text>
      <b-button @click="showAdvert(advert.id)" class="mb-2" variant="primary">Näytä ilmoitus</b-button>
      <b-button @click="deleteAdvert(advert.id)" class="mb-2" variant="danger">Poista</b-button>
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
    showAdvert(id) {
      this.$router.push('/ilmoitus/' + id);
    },
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
