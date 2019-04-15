<template>
  <b-container v-if="id">
    <H1>{{ advert.title }}</H1>

    <!-- Pääkuva voidaan esittää varmaan suoraan. Eli advert-photon voisi heivata pois -->
    <!-- <advert-photo></advert-photo> -->
    <div>
      <b-img :src="'/' + advert.photo" fluid-grow alt="Kiekon kuva" width="50%"/>
    </div>
    <!-- <photo-gallery></photo-gallery> -->
    <!-- <advert-description></advert-description> -->
    <div>
      {{ advert.content}}
    </div>
    <seller-info :seller="seller"></seller-info>
    <advert-messages></advert-messages>
    {{ loggedIn }}
  </b-container>
</template>

<script>
export default {
  name: 'AdvertBody',
  data() {
    return {
      id: this.$route.params.id,
      advert: {},
      seller: {}
    }
  },
  watch: {
    '$route'(to, from) {
      // Päivitetään uusi ilmoituksen id, jotta komponentti päivittyisi oikein
      this.id = to.params.id;
    }
  },
  methods: {
    getAdvertDetails() {
      const url = '/api/ilmoitus/' + this.id;
      fetch(url)
        .then(res => res.json())
        .then(res => {
          this.advert = res.data;
          this.seller = res.user;
          console.log(res.user);
        })
        .catch(err => console.log(err));
    }
  },
  created() {
    if (this.$route.params.id) {
      this.getAdvertDetails();
    }
  },
  computed: {
      loggedIn() {
    //   return this.$store.getters.loggedIn
    let juuseri = localStorage.getItem('access_token');
    return juuseri;
    }
  }
}
</script>

<style scoped>

</style>
