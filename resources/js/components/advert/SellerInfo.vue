<template>
  <div>
    <ul>
      <li>{{ seller ? seller.firstname : '' }} {{  seller ? seller.lastname : '' }}</li>
      <li>{{ seller ? seller.city : '' }}</li>
      <li>{{ seller ? seller.phonenumber : '' }}</li>
      <li>{{ seller ? seller.email : '' }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'SellerInfo',
  props: {
    seller: {}
  }
}
</script>

<style scoped>

</style>
