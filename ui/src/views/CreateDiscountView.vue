<template>
  <div class="discount-form">
    <h2>Create A New Discount</h2>
    <form @submit.prevent="createDiscount">
      <div class="form-div">
        <div class="radio">
          Additional input:
          <input type="radio" value="none" v-model="newDiscount.type"> None
          <input type="radio" value="season" v-model="newDiscount.type"> Discount timeframe
          <input type="radio" value="sales" v-model="newDiscount.type"> Amount of sales
        </div>

        <div v-if="newDiscount.type == 'none'">
          Customer(s):
          <select v-model="newDiscount.customer_ids" class="selectItem">
            <option value="all">All Customers</option>
            <option v-for="customer in customers" :value="customer.id" :key="customer.id">
              {{customer.id}} | {{customer.name}}
            </option>
          </select>
        </div>

        <div>
          Product(s):
          <select v-model="newDiscount.product_ids" class="selectItem">
            <option value="all">All products</option>
            <option v-for="product in products" :value="product.id" :key="product.id">
              {{product.id}} | {{product.name}} | {{product.price}}€
            </option>
          </select>
        </div>

        <div>
          Amount of Discount:
          <input type="number" min="1" max="100" v-model="newDiscount.amount" required> %
        </div>

        <div v-if="newDiscount.type == 'season'">
          Start date:
          <input min="1" type="date" v-model="newDiscount.start_date">
        </div>
                
        <div v-if="newDiscount.type == 'season'">
          End date:
          <input type="date" v-model="newDiscount.end_date">
        </div>

        <div v-if="newDiscount.type == 'sales'">
          Amount of Sales:
          <input type="number" v-model="newDiscount.sales">€
        </div>

        <button type="submit">Add Discount</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
import customers from '../../data/customers.json'
import products from '../../data/products.json'

export default {
  data() {
    return {
      customers: customers,
      products: products,
      newDiscount: {
        customer_ids: 'all',
        product_ids: 'all',
        type: 'none',
        amount: 1,
        amount_type: 'percent',
        sales: 1,
        start_date: null,
        end_date: null,
      },
    }
  },
  methods: {
    // Create a new discount and post it to API
    async createDiscount() {
      // Check given data
      if (this.newDiscount.type == 'season' && this.newDiscount.start_date == null) {
        this.$toast.error(`Missing Start Date!`, {
          duration: 6000,
        });
        return 0;
      }
      if (this.newDiscount.type == 'season' && this.newDiscount.end_date == null) {
        this.$toast.error(`Missing End Date!`, {
          duration: 6000,
        });
        return 0;
      }
      if (this.newDiscount.amount == undefined || this.newDiscount.amount < 1) {
        this.$toast.error(`Discount amount needs to be atleast 1%!`, {
          duration: 6000,
        });
        return 0;
      }
      if (this.newDiscount.amount > 100) {
        this.$toast.error(`Discount amount needs to be smaller than 100%!`, {
          duration: 6000,
        });
        return 0;
      }
      if (this.newDiscount.type == 'sales' && (this.newDiscount.sales == undefined || this.newDiscount.amount < 1)) {
        this.$toast.error(`Discount amount needs to be atleast 1%!`, {
          duration: 6000,
        });
        return 0;
      }
      
      // Make values null based on what type of discount is chosen
      if (this.newDiscount.type == 'none') {
        this.newDiscount.sales = null;
        this.newDiscount.start_date = null;
        this.newDiscount.end_date = null;
      }
      else if (this.newDiscount.type == 'season') {
        this.newDiscount.sales = null;
      }
      else if (this.newDiscount.type == 'sales') {
        this.newDiscount.start_date = null;
        this.newDiscount.end_date = null;
      }

      if (this.newDiscount.customer_ids == 'all') {
        this.newDiscount.customer_ids = (customers.map(obj => obj.id)).toString();
      } else {
        this.newDiscount.customer_ids = ([this.newDiscount.customer_ids]).toString();
      }

      if (this.newDiscount.product_ids == 'all') {
        this.newDiscount.product_ids = (products.map(obj => obj.id)).toString();
      } else {
        this.newDiscount.product_ids = ([this.newDiscount.product_ids]).toString();
      }

      // Replace , => .
      this.newDiscount.amount.replace(",",".");
      this.newDiscount.sales.replace(",",".");

      // Show loader and post discount
      let loader = this.$loading.show({});
      try {
        await axios.post('http://localhost:8080/discounts', this.newDiscount, {withCredentials: true,});
        loader.hide();
        this.$toast.success(`New Discount Created!`, {
          duration: 6000,
        });
      } catch (error) {
        this.$toast.error(`Error Occurred!`, {
          duration: 6000,
        });
      }
      
      // Set empty discount
      this.emptyDiscount();
    },
    // Initialize discount
    emptyDiscount() {
      this.newDiscount.customer_ids= 'all';
      this.newDiscount.product_ids= 'all';
      this.newDiscount.amount= 1;
      this.newDiscount.sales= 1;
      this.newDiscount.type= 'none';
      this.newDiscount.amount_type= 'percent';
      this.newDiscount.start_date= null;
      this.newDiscount.end_date= null;
    }
  },
};
</script>

<style>

.discount-form {
  margin-top: 5em;
}

.form-div {
  display: grid;
  height: 100%;
  margin-top: 1em;
  gap: 6px;
}

.form-div div {
  width: 100%;
}

h2 {
  margin-bottom: 15px;
}

select {
  width: 100%;
}

button {
  margin-top: 10px;
}

</style>