<template>
        <div class="popup-content">
            <h2>Add A New Discount</h2>
            <form @submit.prevent="createDiscount">

                <select v-model="newDiscount.customer_id" class="selectItem">
                    <option v-for="customer in customers" :value="customer.id">
                        {{customer.id}} : {{customer.name}}
                    </option>
                </select>

                <select v-model="newDiscount.product_id" class="selectItem">
                    <option v-for="product in products" :value="product.id">
                        {{product.id}} : {{product.name}}
                    </option>
                </select>

                <label for="count">Count:</label>
                <input type="number" v-model="newDiscount.count" required>

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
              count: 0,
            },
        }
    },
    methods: {
      async createDiscount() {
        try {
          await axios.post('http://localhost:8080/discounts', this.newDiscount, {withCredentials: true,});
          console.log('Discount created successfully');
        } catch (error) {
          console.error('Error creating discount:', error);
        }
      },
    },
};
</script>