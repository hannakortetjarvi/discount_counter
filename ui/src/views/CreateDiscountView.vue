<template>
        <div class="popup-content">
            <h2>Add A New Discount</h2>
            <form @submit.prevent="createDiscount">
                <div>
                  Additional input
                  <input type="radio" value="none" v-model="newDiscount.type"> None
                  <input type="radio" value="season" v-model="newDiscount.type"> Discount timeframe
                  <input type="radio" value="sales" v-model="newDiscount.type"> Amount of sales
                </div>

                <select v-if="newDiscount.type == 'none'" v-model="newDiscount.customer_ids" class="selectItem">
                    <option value="all">All Customers</option>
                    <option v-for="customer in customers" :value="customer.id">
                        {{customer.id}} | {{customer.name}}
                    </option>
                </select>

                <select v-model="newDiscount.product_ids" class="selectItem">
                    <option value="all">All products</option>
                    <option v-for="product in products" :value="product.id">
                        {{product.id}} | {{product.name}} | {{product.price}}€
                    </option>
                </select>

                Amount
                <input type="number" min="1" max="100" v-model="newDiscount.amount" required> %

                <input v-if="newDiscount.type == 'season'" type="date" v-model="newDiscount.start_date">
                <input v-if="newDiscount.type == 'season'" type="date" v-model="newDiscount.end_date">
                <input v-if="newDiscount.type == 'sales'" type="number" min="1" v-model="newDiscount.sales">

                <button type="submit">Add Discount</button>
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
              amount: 0,
              amount_type: 'percent',
              sales: null,
              start_date: null,
              end_date: null,
            },
        }
    },
    methods: {
      async createDiscount() {
        if (this.selectedType == 'none') {
          this.newDiscount.sales = null;
          this.newDiscount.start_date = null;
          this.newDiscount.end_date = null;
        }
        else if (this.selectedType == 'season') {
          this.newDiscount.sales = null;
        }
        else if (this.selectedType == 'sales') {
          this.newDiscount.start_date = null;
          this.newDiscount.end_date = null;
        }

        if (this.newDiscount.customer_ids == 'all') {
          this.newDiscount.customer_ids = customers.map(obj => obj['id']);
        } else {
          this.newDiscount.customer_ids = [this.newDiscount.customer_ids];
        }

        if (this.newDiscount.product_ids == 'all') {
          this.newDiscount.product_ids = products.map(obj => obj['id']);
        } else {
          this.newDiscount.product_ids = [this.newDiscount.product_ids];
        }

        console.log(this.newDiscount);

        try {
          await axios.post('http://localhost:8080/discounts', this.newDiscount, {withCredentials: true,});
        } catch (error) {
          console.error('Error creating discount:', error);
        }
        
        this.emptyDiscount();
      },
      emptyDiscount() {
        this.newDiscount.customer_id= null;
        this.newDiscount.product_id= '';
        this.newDiscount.amount= 0;
        this.newDiscount.sales= null;
        this.newDiscount.type= 'none';
        this.newDiscount.amount_type= 'percent';
        this.newDiscount.start_date= null;
        this.newDiscount.end_date= null;
      }
    },
};
</script>