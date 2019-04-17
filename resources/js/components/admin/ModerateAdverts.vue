<template>
<b-container>

  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li
        :class="[{disabled: !pagination.prev_page_url}]"
        class="page-item"><a class="page-link"
        @click="getAdverts(pagination.prev_page_url)"
        :style="{ cursor: 'pointer'}">Edellinen</a></li>
      <li class="page-item disabled"><a class="page-link text-dark">Sivu {{ pagination.current_page }}/{{ pagination.last_page }}</a></li>
      <li class="page-item">
        <a :class="[{disabled: !pagination.next_page_url}]" class="page-link"
        @click="getAdverts(pagination.next_page_url)" 
        :style="{ cursor: 'pointer'}">Seuraava
        </a>
        </li>
    </ul>
  </nav>


  <b-card-group columns>
    <search-result-item  id="ilmoitukset"
      v-for="advert in adverts" :key="advert.id"
      :advert="advert"
      :counter="advert.id"
      @refreshAdverts="getAdverts(current_page_url)"
      moderate
      />
  </b-card-group>

    <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li
        :class="[{disabled: !pagination.prev_page_url}]"
        class="page-item"><a class="page-link"
        @click="getAdverts(pagination.prev_page_url)"
        :style="{ cursor: 'pointer'}">Edellinen</a></li>
      <li class="page-item disabled"><a class="page-link text-dark">Sivu {{ pagination.current_page }}/{{ pagination.last_page }}</a></li>
      <li class="page-item">
        <a :class="[{disabled: !pagination.next_page_url}]" class="page-link"
        @click="getAdverts(pagination.next_page_url)" 
        :style="{ cursor: 'pointer'}">Seuraava
        </a>
        </li>
    </ul>
  </nav>

  </b-container>
</template>

<script>
export default {
  name: 'SearchResults',
  data: function() {
    return {
      adverts: [],
      advert: {
        id: '',
        title: '',
        content: ''
      },
      advert_id: '',
      pagination: {},
      edit: false,
      current_page_url: ''
    }
  },
  methods: {
    testi() {
      console.log('Pgjhgjhg');
    },
    getAdverts(page_url) {
      if (page_url) {
        this.current_page_url = page_url;
        console.log(this.current_page_url);
      }
      let vm = this;
      page_url = page_url || 'api/moderoi';
      fetch(page_url)
      .then(res => res.json())
      .then(res => {
        this.adverts = res.data;
        vm.makePagination(res.meta, res.links);
      })
      .catch(err => console.log(err));
    },
    makePagination(meta, links){
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      }
      this.pagination = pagination;
    }
  },
  computed: {

  },
  created() {
    this.getAdverts();
  }
}
</script>

<style scoped>
#ilmoitukset {
    background-color:beige;
}
</style>