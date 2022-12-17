<template>
  <button class="btn" @click="onClick()" :style="{ background: color }">
    {{description}}
  </button>
</template>

<script>
export default {
  name: "Button",
  props: {
    description: String,
    color: String
  },
  methods: {
    onClick() {
      this.$emit('btn-click')
    }
  }
}
</script>

<style scoped>

</style>