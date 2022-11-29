<template>
  <div :key="task.id" class="task-div" v-for="task in tasks">
    <Task @delete-task="$emit('delete-task', task.id)" :task="task"/>
  </div>
</template>

<script>
import Task from '../components/Task.vue'

export default {
  name: "Tasks",
  props: {
    tasks: Array
  },
  components: {
    Task
  },
  emits: ['delete-task'],
}
</script>

<style scoped>
  .task-div {
    margin-top: 10px;
  }
</style>