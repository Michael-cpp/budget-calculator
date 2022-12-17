<template>
  <header>
    <h1>{{totalBudget}} &#8382;</h1>
    <Button
        @btn-click="$emit('toggle-add-purchase')"
        :description="showAddPurchase ? 'Close' : 'Add'"
        :color="showAddPurchase ? 'red' : 'green'"
    />

  </header>
</template>

<script>
import Button from '../components/Button.vue'

export default {
  name: 'Header',
  props: {
    title: String,
    showAddPurchase: Boolean,
    totalBudget: 0,
  },
  components: {
    Button,
  },
}
</script>

<style scoped>
header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}
</style>