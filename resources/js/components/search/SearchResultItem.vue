<template>
    <b-card 
      :title="advert.title" 
      :img-src="'/' + advert.photo" 
      img-alt="Kiekon kuva" 
      img-top>
      <b-card-text>
        {{ advert.content }}
      </b-card-text>
      <b-button @click="showAdvert(advert.id)" class="mb-2" variant="primary">Näytä ilmoitus</b-button>
      <template v-if="!moderate">
        <b-button v-if="ownAdvert" @click.prevent="modifyAdvert(advert.id)" class="mb-2" variant="success">Muokkaa</b-button>
        <b-button v-if="ownAdvert" @click.prevent="deleteAdvert(advert.id)" class="mb-2" variant="danger">Poista</b-button>
      </template>
      <template v-else>
        <b-button @click.prevent="acceptAdvert(advert.id)" class="mb-2" variant="success">Hyväksy</b-button>
        <b-button @click.prevent="refuseAdvert(advert.id)" class="mb-2" variant="danger">Hylkää</b-button>
      </template>

      <div slot="footer"><small class="text-muted">Ilmoitus päivitetty {{ updated }}</small></div>
    </b-card>  
</template>
      <!-- @click="showAdvert(advert.id)"
      :style="{ cursor: 'pointer'}" -->

<script>
import moment from 'moment';
export default {
  name: 'SearchResultItem',
  props: {
    advert: {},
    counter: Number,
    moderate: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    updated() {
      // return 'test';
      moment.locale( "fi" );
      return moment(this.advert.updated_at).fromNow();
    },
    userdetails() {
        return this.$store.getters.userdetails;
    },
    ownAdvert() {
      // console.log(this.advert.user_id);
      // console.log(this.$store.getters.userdetails.id);
      return this.advert.user.user_id === this.$store.getters.userdetails.id;
    }
  },
  methods: {
    showAdvert(id) {
      this.$router.push('/ilmoitus/' + id);
    },
    modifyAdvert(id) {
      this.$router.push('/ilmoita/' + id);
    },
    deleteAdvert(id) {
      if (confirm('Haluatko varmasti poistaa ilmoituksen?')) {
        fetch(`/api/ilmoitus/${id}`, {
          method: 'delete'
        })
        .then(res => res.json)
        .then(data => {
          alert('Ilmoitus poistettu!');
          this.$emit('refreshAdverts')
        })
        .catch(err => console.log(err));
      }
    },
    acceptAdvert(id) {
      if (confirm('Haluatko hyväksyä ilmoituksen?')) {
        fetch(`/api/hyvaksy/${id}`, {
          method: 'put'
        })
        .then(res => res.json)
        .then(data => {
          console.log('Ilmoitus hyväksytty!');
          this.$emit('refreshAdverts')
        })
        .catch(err => console.log(err));
      }
    },
    refuseAdvert(id) {
      if (confirm('Haluatko hylätä ilmoituksen?')) {
        fetch(`/api/hylkaa/${id}`, {
          method: 'put'
        })
        .then(res => res.json)
        .then(data => {
          console.log('Ilmoitus hylätty!');
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
