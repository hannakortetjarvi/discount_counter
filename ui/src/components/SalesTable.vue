<template>
    <table>
        <thead>
          <div v-if="showUpdateForm" class="popup">
              <div class="popup-content">
                  <h2>Update Sale</h2>
                  <form @submit.prevent="updateSale">

                    <label for="customer_id">Customer:</label>
                    <select v-model="updatedSale.customer_id" class="selectItem">
                      <option v-for="customer in customers" :value="customer.id" :key="customer.id">
                        {{customer.id}} | {{customer.name}}
                      </option>
                    </select>

                    <label for="product_id">Product:</label>
                    <select v-model="updatedSale.product_id" class="selectItem">
                      <option v-for="product in products" :value="product.id" :key="product.id">
                        {{product.id}} | {{product.name}} | {{product.price}}€
                      </option>
                    </select>

                      <label for="count">Count:</label>
                      <input type="number" v-model="updatedSale.count" required>

                      <button class="close" @click="closeUpdateForm">Close</button>
                      <button type="submit">Update</button>
                  </form>
              </div>
          </div>
          <tr>
            <th>Sale Id</th>
            <th>Customer Id</th>
            <th>Product Id</th>
            <th>Count (how many products)</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="sale in sales" :key="sale.id">
            <td>{{ sale.id }}</td>
            <td>{{ sale.customer_id }}</td>
            <td>{{ sale.product_id }}</td>
            <td>{{ sale.count}}</td>
            <td>
              <button @click="openForm(sale)">Update</button>
              <button @click="confirmDelete(sale.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
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
            sales: [],
            showUpdateForm: false,
            updatedSale: {
              id: 0,
              customer_id: '',
              product_id: '',
              count: 1,
            },
        }
    },
    watch: { 
        products: function(newVal, oldVal) {
            console.log('Data changed: ', oldVal.length, ' --> ', newVal.length);
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
      async fetchData() {
        try {
          const resp = await axios.get('http://localhost:8080/sales');
          console.log(resp);
          this.sales = resp.data;
        } catch (error) {
          console.error('Error fetching data:', error);
        };
      },
      openForm(sale) {
        this.updatedSale = { ...sale };
        this.showUpdateForm = true;
      },
      closeUpdateForm() {
        this.showUpdateForm = false;
      },
      async updateSale() {
        try {
          await axios.put(`http://localhost:8080/sales/${this.updatedSale.id}`, this.updatedSale, {withCredentials: true});
          console.log('Sale updated successfully');
          this.showUpdateForm = false;
          this.fetchData();
          this.closeUpdateForm();
          this.updatedSale.id = 0,
          this.updatedSale.customer_id = '';
          this.updatedSale.product_id = '';
          this.updatedSale.count = 1;
        } catch (error) {
          console.error('Error updating sale:', error);
        }
      },
      async confirmDelete(saleId) {
        const userConfirmed = window.confirm('Are you sure you want to delete this sale?');

        if (userConfirmed) {
          await this.delete(saleId);
        }
      },
      async delete(saleId) {
        console.log(saleId);
        try {
          await axios.delete(`http://localhost:8080/sales/${saleId}`, {withCredentials: true});
          console.log('Sale deleted successfully');
          this.fetchData();
        } catch (error) {
          console.error('Error deleting sale:', error);
        }
      },
    },
};
</script>