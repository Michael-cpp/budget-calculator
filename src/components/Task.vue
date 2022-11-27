<template>
  <div class="task">
    <h3>
      {{task.description}}
      <i
          @click="$emit('delete-task', task.id)"
          class="fa-solid"
      >x</i>
    </h3>
    <p>{{task.price_1}}</p>
    <p>{{task.price_2}}</p>
  </div>

</template>

<script>
export default {
  name: "Task",
  props: {
    task: Object
  },
  methods: {

  }
}
</script>

<style scoped>
  .fa-solid {
    color: red;
  }

  .task {
    background: #f4f4f4;
    margin: 5px;
    padding: 10px 20px;
    cursor: pointer;
  }

  .task.reminder {
    border-left: 5px solid green;
  }

  .task h3 {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
</style>