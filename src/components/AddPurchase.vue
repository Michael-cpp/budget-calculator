<template>
  <form @submit="onSubmit" class="add-form">
    <div class="form-control">
      <input type="text" v-model="description" name="description" placeholder="Description" />
    </div>
    <div class="form-control price-container width-45">
      <input type="number" min="0" max="900" step="1" v-model="price_1" name="price_1" placeholder="&#8382;" />
    </div>
    <div class="price-container dot-container">
      <p><strong>&bull;</strong></p>
    </div>
    <div class="form-control price-container width-45">
      <input type="number" min="0" max="95" step="5" v-model="price_2" name="price_2" placeholder="tetri" />
    </div>
    <div class="form-control">
      <select name="buyer" v-model="buyer">
        <option v-for="option in buyer_list" :value="option.value">
          {{ option.text }}
        </option>
      </select>
    </div>
    <div class="form-control">
      <select name="owner" v-model="owner">
        <option v-for="option in owner_list" :value="option.value">
          {{ option.text }}
        </option>
      </select>
    </div>
    <input type="submit" value="Save purchase" class="btn btn-block" />
  </form>
</template>

<script>
export default {
  name: "Addpurchase",
  data() {
    return {
      description: '',
      price_1: 0,
      price_2: "00",
      buyer: 0,
      owner: 0,
      date_create : 0,

      buyer_list: [
        { text: 'Buyer', value: '0' },
        { text: 'Mikhail', value: '1' },
        { text: 'Dmitry', value: '2' },
      ],
      owner_selected: 0,
      owner_list: [
        { text: 'Owner', value: '0' },
        { text: 'Mikhail', value: '1' },
        { text: 'Dmitry', value: '2' },
        { text: 'Both', value: '3' },
      ],
    }
  },
  methods: {
    onSubmit(e) {
      e.preventDefault();

      let description = this.description.trim().toLowerCase();
      if(!this.description) {
        alert('Please fill out all required fields');
        return;
      }

      if(!this.price_1 && !this.price_2) {
        alert('Please fill out price');
        return;
      }
      let price = Number(this.price_1) * 100 + Number(this.price_2);
      if(!price) {
        alert('Wrong price');
        return;
      }

      if(!this.buyer) {
        alert('Please fill out buyer');
        return;
      }
      if(!this.owner) {
        alert('Please fill out owner');
        return;
      }
      const newpurchase = {
        description: description,
        price: price,
        buyer: this.buyer,
        owner: this.owner,
        date_create: new Date().getTime(),
      }
      this.$emit('add-purchase', newpurchase);
      this.description = '';
      this.price_1 = 0;
      this.price_2 = 0;
      this.buyer = 0;
      this.owner = 0;
      this.date_create = 0;
    }
  }
}
</script>

<style scoped>
.add-form {
  margin-bottom: 40px;
}

.form-control {
  margin: 20px 0;
}

.form-control label {
  display: block;
}

.form-control input, .form-control select {
  width: 100%;
  height: 40px;
  padding: 3px 7px;
  font-size: 17px;
}

.form-control-check {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.form-control-check label {
  flex: 1;
}

.form-control-check input {
  flex: 2;
  height: 20px;
}

.price-container {
  display: inline-block;
  vertical-align: bottom;
  margin: 0;
}

.dot-container {
  width: 10%;
  text-align: center;
}

.width-45 {
  width: 45%;
}
</style>