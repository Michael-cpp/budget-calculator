<template>
  <Header title="purchase Tracker" @toggle-add-purchase="toggleAddPurchase" :showAddpurchase="showAddPurchase" :totalBudget="totalBudget" />
  <AddPurchase v-show="showAddPurchase" @add-purchase="addPurchase" />
  <purchases @delete-purchase="deletePurchase" :purchases="purchases"/>
</template>

<script>
import Header from "./components/Header.vue";
import Purchases from "./components/Purchases.vue";
import AddPurchase from "./components/AddPurchase.vue";

export default {
  name: 'App',
  components: {
    Header,
    Purchases,
    AddPurchase,
  },
  props: {
  },
  data() {
    return {
      showAddPurchase: false,
      purchases: [],
    }
  },
  methods: {
    toggleAddPurchase() {
      this.showAddPurchase = !this.showAddPurchase;
    },
    async addPurchase(purchase) {
      const res = await fetch( 'http://localhost:5000/purchases', {
        method: 'POST',
        headers: {
          'Content-type': 'application/json',
        },
        body: JSON.stringify(purchase),
      })
      const data = await res.json();
      this.purchases = [data, ...this.purchases];
    },
    async deletePurchase(id) {
      if(confirm('Are you sure?')) {
        const res = await fetch(`http://localhost:5000/purchases/${id}`, {
          method: 'DELETE'
        });
        res.status === 200 ? (this.purchases = this.purchases.filter((purchase) => purchase.id !== id)) : alert('Error deleting purchase');
      }
    },
    async fetchPurchases() {
      const res = await fetch('http://localhost:5000/purchases?_sort=date_create&_order=desc');
      const data = await res.json();
      return data;
    },
    async fetchPurchase(id) {
      const res = await fetch(`http://localhost:5000/purchases/${id}`);
      const data = await res.json();
      return data;
    },
    extra_round(num) {
      return Math.round((num + Number.EPSILON) * 100) / 100;
    }
  },
  computed: {
    totalBudget() {
      let budget = 0;
      for (let i = this.purchases.length - 1; i >= 0; i--) {
        let price = (this.purchases[i].owner == 3 ? this.extra_round(this.purchases[i].price / 2) : this.purchases[i].price);
        if(this.purchases[i].buyer == 1) {
          budget -= price;
        } else {
          budget += price;
        }
      }
      return this.extra_round(budget / 100);
    }
  },
  async created() {
    this.purchases = await this.fetchPurchases();
  }
}

</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap');

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Poppins', sans-serif;
}

.container {
  max-width: 500px;
  margin: 30px auto;
  overflow: auto;
  min-height: 300px;
  border: 1px solid steelblue;
  padding: 30px;
  border-radius: 5px;
}

.btn {
  display: inline-block;
  background: #000;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  text-decoration: none;
  font-size: 15px;
  font-family: inherit;
}

.btn:focus {
  outline: none;
}

.btn:active {
  transform: scale(0.98);
}

.btn-block {
  display: block;
  width: 100%;
}
</style>
