<template>
<b-container>

    <div class="overflow-auto">
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
      :per-page="perPage"
      :current-page="currentPage"
      small
    />
  </div>

  <!-- <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li
      :class="[{disabled: !pagination.prev_page_url}]"
      class="page-item"><a class="page-link"
      @click="getAdverts(pagination.prev_page_url)">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a
      :class="[{disabled: !pagination.next_page_url}]"
      class="page-link"
      @click="getAdverts(pagination.next_page_url)">Next</a></li>
  </ul>
</nav> -->


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
      advert_id: '',
      pagination: {},
      edit: false,
      perPage: 5,
      currentPage: 1,
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
    getAdverts(page_url) {
      console.log(page_url);
      let vm = this;
      page_url = page_url || 'ilmoitukset';
      axios
      .get(page_url)
      .then(response => {
        this.adverts = response.data.data;
      vm.makePagination(response.data.links, response.data.meta);
      })
      .catch(err => console.log(err));
    },
    makePagination(links, meta){
      var test = links.prev ? links.prev.substring(links.prev.lastIndexOf("/") + 1, links.prev.length) : null;
      console.log(test);

      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page ,
        next_page: links.next.substring(links.next.lastIndexOf("/") + 1, links.next.length),
        prev_page: links.prev ? links.prev.substring(links.prev.lastIndexOf("/") + 1, links.prev.length) : null
      }
      this.pagination = pagination;
    }
  },
  computed: {
      rows() {
        return this.adverts.length
      }
  },
  mounted() {
    this.getAdverts();
  }
}
</script>

<style scoped>

</style>
