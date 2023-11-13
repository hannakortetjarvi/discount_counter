<template>
        <div class="popup-content">
            <h2>Add A New Sale</h2>
            <form @submit.prevent="createSale">
                <select v-model="newSale.customer_id" class="selectItem">
                    <option v-for="customer in customers" :value="customer.id" :key="customer.id">
                        {{customer.id}} | {{customer.name}}
                    </option>
                </select>

                <select v-model="newSale.product_id" class="selectItem">
                    <option v-for="product in products" :value="product.id" :key="product.id">
                        {{product.id}} | {{product.name}} | {{product.price}}€
                    </option>
                </select>

                <label for="count">Count:</label>
                <input type="number" min="1" v-model="newSale.count" required>

                <button type="submit">Add Sale</button>
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
            newSale: {
              customer_id: '',
              product_id: '',
              count: 1,
            },
        }
    },
    methods: {
      async createSale() {
        try {
          await axios.post('http://localhost:8080/sales', this.newSale, {withCredentials: true,})
        } catch (error) {
          console.error('Error fetching data:', error);
        }
        this.newSale.customer_id = '';
        this.newSale.product_id = '';
        this.newSale.count = 1;
      },
    },
};
</script>