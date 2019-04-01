<template>
<b-container>

    <!-- <div class="overflow-auto">
    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="myTable"
    />
    <p class="mt-3">Current Page: {{ currentPage }}</p>

    <b-table
      id="myTable"
      :items="adverts"
      :fields="fields"
      :per-page="perPage"
      :current-page="currentPage"
      small
      hover>

      <template slot="index" slot-scope="data">
        {{ data.id }}
      </template>

      <template slot="name" slot-scope="data">
        {{ data.firstname }}
      </template>
    </b-table>
  </div> -->

  <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li
      :class="[{disabled: !pagination.prev_page_url}]"
      class="page-item"><a class="page-link" href="#"
      @click="getAdverts(pagination.prev_page_url)">Edellinen</a></li>
    <li class="page-item disabled"><a class="page-link text-dark" href="#">Sivu {{ pagination.current_page }}/{{ pagination.last_page }}</a></li>
    <li class="page-item"><a
      :class="[{disabled: !pagination.next_page_url}]"
      class="page-link" href="#"
      @click="getAdverts(pagination.next_page_url)">Seuraava</a></li>
  </ul>
</nav>


  <b-card-group columns>
    <search-result-item
      v-for="advert in adverts" :key="advert.id"
      :advert="advert"
      :counter="advert.id"
      @refreshAdverts="getAdverts(current_page_url)"
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
      page_url = page_url || 'api/ilmoitukset';
      fetch(page_url)
      .then(res => res.json())
      .then(res => {
        this.adverts = res.data;
        vm.makePagination(res.meta, res.links);
      })
      .catch(err => console.log(err));
      // console.log(page_url);
      // let vm = this;
      // page_url = page_url || 'ilmoitukset';
      // axios
      // .get('ilmoitukset')
      // .then(response => {
      //   this.adverts = response.data.data;
      // // vm.makePagination(response.data.links, response.data.meta);
      // })
      // .catch(err => console.log(err));
    },
    makePagination(meta, links){
      // var test = links.prev ? links.prev.substring(links.prev.lastIndexOf("/") + 1, links.prev.length) : null;
      // console.log(test);

      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev

        // next_page: links.next.substring(links.next.lastIndexOf("/") + 1, links.next.length),
        // prev_page: links.prev ? links.prev.substring(links.prev.lastIndexOf("/") + 1, links.prev.length) : null
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

</style>
