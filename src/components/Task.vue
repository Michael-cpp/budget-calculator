<template>
  <div class="task">
    <p class="title">
      {{date_create}}
      <i @click="$emit('delete-task', task.id)" class="fa-solid">x</i>
    </p>
    <h3>{{task.description}}</h3>
    <p class="price">{{price}} &#8382; {{buyer}}</p>
    <p>{{owner}}</p>
  </div>

</template>

<script>
export default {
  name: "Task",
  props: {
    task: Object,
  },
  data() {
    return {
      owner_list: Object
    }
  },
  computed: {
    price() {
      return this.task.price / 100;
    },
    date_create() {
      let date = new Date(this.task.date_create);
      let date_string = date.getDate() + '.' + date.getMonth() + '.' + date.getFullYear() + ' ' +
          date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
      return date_string;
    },
    buyer() {
      return this.owner_list[this.task.buyer];
    },
    owner() {
      return this.owner_list[this.task.owner];
    }
  },
  created() {
    this.owner_list = {
      1: 'Mikhail',
      2: 'Dmitry',
      3: 'Both'
    }
  },
  methods: {

  }
}
</script>

<style scoped>
  .fa-solid {
    color: red;
    cursor: pointer;
  }

  .task {
    background: #f4f4f4;
    margin: 5px;
    padding: 10px 20px;
  }

  .task.reminder {
    border-left: 5px solid green;
  }

  .task .title {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .task .price {
    font-weight: bold;
  }
</style>