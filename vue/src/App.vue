<template>
  <Header title="purchase Tracker" @toggle-add-purchase="toggleAddPurchase" :showAddPurchase="showAddPurchase" :totalBudget="totalBudget" />
  <AddPurchase v-show="showAddPurchase" @add-purchase="addPurchase" />
  <purchases @delete-purchase="deletePurchase" :purchases_list="purchases_list"/>
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
      purchases_list: [],
      api_url: '/api/index.php?',
    }
  },
  methods: {
    toggleAddPurchase() {
      this.showAddPurchase = !this.showAddPurchase;
    },
    async addPurchase(purchase) {
      const res = await fetch( this.api_url+'entity=purchase', {
        method: 'POST',
        headers: {
          'Content-type': 'application/json',
        },
        body: JSON.stringify(purchase),
      })
      const data = await res.json();
      this.purchases = [data, ...this.purchases];
      this.purchases_list = [data, ...this.purchases_list];
    },
    async deletePurchase(id) {
      if(confirm('Are you sure?')) {
        const res = await fetch(this.api_url+'entity=purchase&id='+id, {
          method: 'DELETE'
        });
        if(res.status === 200) {
          this.purchases = this.purchases.filter((purchase) => purchase.id !== id);
          this.purchases_list = this.purchases_list.filter((purchase) => purchase.id !== id);
        } else {
          alert('Error deleting purchase');
        }
      }
    },
    async fetchPurchases() {
      const res = await fetch(this.api_url+'entity=purchase');
      const data = await res.json();
      console.log(data);
      return data;
    },
    async fetchPurchase(id) {
      const res = await fetch(this.api_url+'entity=purchase&id='+id);
      const data = await res.json();
      return data;
    },
    extra_round(num) {
      return Math.round((num + Number.EPSILON) * 100) / 100;
    },
    handleScroll() {
      if (window.scrollY + window.innerHeight >= document.body.scrollHeight - 50) {
        let len = this.purchases_list.length;
        let add_data = this.purchases.slice(len, len+10)
        this.purchases_list = [
            ...this.purchases_list, ...add_data
        ]
      }
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
    this.purchases_list = this.purchases.slice(0, 10);
    window.addEventListener('scroll', this.handleScroll);
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
