<template>
  <div>
    <ul>
      <li>{{ user.firstname }} {{ user.lastname }}</li>
      <li>{{ user.nickname }}</li>
      <li>{{ user.city }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'SearchInfo',
  props: {
    user: {}
  }
}
</script>

<style scoped>

</style>
