<template>
  <div :key="purchase.id" class="purchase-div" v-for="purchase in purchases_list">
    <purchase @delete-purchase="$emit('delete-purchase', purchase.id)" :purchase="purchase"/>
  </div>
</template>

<script>
import Purchase from '../components/Purchase.vue'

export default {
  name: "purchases",
  props: {
    purchases_list: Array
  },
  components: {
    Purchase
  },
  emits: ['delete-purchase'],
}
</script>

<style scoped>
  .purchase-div {
    margin-top: 10px;
  }
</style>