<template>
        <div class="popup-content">
            <h2>Add A New Discount</h2>
            <form @submit.prevent="createDiscount">

                <select v-model="newDiscount.customer_id" class="selectItem">
                    <option v-for="customer in customers" :value="customer.id">
                        {{customer.id}} | {{customer.name}}
                    </option>
                </select>

                <select v-model="newDiscount.product_id" class="selectItem">
                    <option v-for="product in products" :value="product.id">
                        {{product.id}} | {{product.name}} | {{product.price}} 
                    </option>
                </select>

                Amount
                <input type="number" v-model="newDiscount.amount" required>
                <div>
                  Additional input
                  <input type="radio" value="percent" v-model="newDiscount.amount_type"> %
                  <input type="radio" value="euro" v-model="newDiscount.amount_type"> €
                </div>

                <div>
                  Additional input
                  <input type="radio" value="none" v-model="newDiscount.type"> None
                  <input type="radio" value="season" v-model="newDiscount.type"> Discount timeframe
                  <input type="radio" value="sales" v-model="newDiscount.type"> Amount of sales
                </div>

                <input v-if="newDiscount.type == 'season'" type="date" v-model="newDiscount.start_date">
                <input v-if="newDiscount.type == 'season'" type="date" v-model="newDiscount.end_date">
                <input v-if="newDiscount.type == 'sales'" type="number" v-model="newDiscount.sales">

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
              customer_id: '',
              product_id: '',
              type: 'none',
              amount: 0,
              amount_type: 'percent',
              sales: 0,
              start_date: null,
              end_date: null,
            },
        }
    },
    methods: {
      async createDiscount() {
        if (this.selectedType == 'none') {
          this.newDiscount.sales = 0;
          this.newDiscount.start_date = null;
          this.newDiscount.end_date = null;
        }
        else if (this.selectedType == 'season') {
          this.newDiscount.sales = 0;
        }
        else if (this.selectedType == 'sales') {
          this.newDiscount.start_date = null;
          this.newDiscount.end_date = null;
        }
        console.log(this.newDiscount);
        try {
          await axios.post('http://localhost:8080/discounts', this.newDiscount, {withCredentials: true,});
        } catch (error) {
          console.error('Error creating discount:', error);
        }
        this.newDiscount.customer_id= '';
        this.newDiscount.product_id= '';
        this.newDiscount.amount= 0;
        this.newDiscount.sales= 0;
        this.newDiscount.type= 'none';
        this.newDiscount.amount_type= 'percent';
        this.newDiscount.start_date= null;
        this.newDiscount.end_date= null;
      },
    },
};
</script>