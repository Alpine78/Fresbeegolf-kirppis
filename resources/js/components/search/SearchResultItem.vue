<template>
  <b-container>
    <b-row>
      <search-description
        :title="advert.title"
        :content="advert.content"
      />
      <search-photo></search-photo>
      <search-info
        :user="advert.user"
      />
    </b-row>
  </b-container>
</template>

<script>
export default {
  name: 'SearchResultItem',
  props: {
    advert: {}
  }
}
</script>

<style scoped>

</style>
