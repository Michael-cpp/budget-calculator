<template>
  <form @submit="onSubmit" class="add-form">
    <div class="form-control">
      <input type="text" v-model="description" name="description" placeholder="Description" />
    </div>
    <div class="form-control">
      <input type="number" min="0" max="900" step="1" v-model="price_1" name="price_1" placeholder="Add Day & Time" />
    </div>
    <div class="form-control">
      <input type="number" min="0" max="95" step="5" v-model="price_2" name="price_2" placeholder="Add Day & Time" />
    </div>
    <div class="form-control">

      <select name="buyer" v-model="buyer">
        <option value="">Buyer</option>
        <option value="1">Mikhail</option>
        <option value="2">Dmitry</option>
      </select>
    </div>
    <div class="form-control">
      <select name="owner">
        <option value="">Owner</option>
        <option value="1">Mikhail</option>
        <option value="2">Dmitry</option>
        <option value="3">Both</option>
      </select>
    </div>
    <input type="submit" value="Save Task" class="btn btn-block" />
  </form>
</template>

<script>
export default {
  name: "AddTask",
  data() {
    return {
      description: '',
      price_1: 0,
      price_2: 0,
    }
  },
  methods: {
    onSubmit(e) {
      e.preventDefault();
      if(!this.description) {
        alert('Please fill out all required fields');
        return;
      }
      if(!this.price_1 && !this.price_2) {
        alert('Please fill out price');
        return;
      }/*
      if(!this.buyer) {
        alert('Please fill out buyer');
        return;
      }
      if(!this.owner) {
        alert('Please fill out owner');
        return;
      }*/
      const newTask = {
        description: this.description,
        price_1: this.price_1,
        price_2: this.price_2,
      }
      this.$emit('add-task', newTask);
      this.description = '';
      this.price_1 = 0;
      this.price_2 = 0;
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
  margin: 5px;
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
</style>