<template>
  <div class="purchase">
    <p class="title">
      {{date_create}}
      <p @click="$emit('delete-purchase', purchase.id)" class="del-btn">x</p>
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
      let datetime = new Date(this.purchase.date_create);
      let date = String(datetime.getDate()).padStart(2, '0');
      let month = String(datetime.getMonth()+1).padStart(2, '0');
      let year = datetime.getFullYear();
      let hour = datetime.getHours();
      let minute = String(datetime.getMinutes()).padStart(2, '0');
      let second = String(datetime.getSeconds()).padStart(2, '0');
      let date_string = date + '.' + month + '.' + year + ' ' + hour + ':' + minute + ':' + second;
      return date_string;
    },
    buyer() {
      return this.owner_list[this.purchase.buyer];
    },
    owner() {
      if (this.purchase.owner === 3) {
        return '';
      }
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
  .del-btn {
    color: red;
    cursor: pointer;
    font-size: 15px;
    font-weight: bold;
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