<template>
  <div class="purchase">
    <p class="title">
      {{date_create}}
      <i @click="$emit('delete-purchase', purchase.id)" class="fa-solid">x</i>
    </p>
    <h3>{{purchase.description}}</h3>
    <p class="price">
      <span class="price">{{price}} &#8382; {{buyer}}</span>
      <span>{{owner}}</span>
    </p>
  </div>
</template>

<script>
export default {
  name: "purchase",
  props: {
    purchase: Object,
  },
  data() {
    return {
      owner_list: Object
    }
  },
  computed: {
    price() {
      return this.purchase.price / 100;
    },
    date_create() {
      let date = new Date(this.purchase.date_create);
      let date_string = String(date.getDate()).padStart(2, '0') + '.' + String(date.getMonth()).padStart(2, '0') + '.' + date.getFullYear() + ' ' +
          date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
      return date_string;
    },
    buyer() {
      return this.owner_list[this.purchase.buyer];
    },
    owner() {
      return this.owner_list[this.purchase.owner];
    }
  },
  created() {
    this.owner_list = {
      1: 'Mikhail',
      2: 'Dmitry',
      3: 'both'
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

  .purchase {
    background: #f4f4f4;
    padding: 10px 20px;
  }

  .purchase .title, .purchase .price {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .purchase .price {
    font-weight: bold;
  }
</style>