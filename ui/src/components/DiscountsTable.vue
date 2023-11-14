<template>
    <table>
        <thead>
          <div v-if="showUpdateForm" class="popup">
              <div class="popup-content">
                  <h2>Update Discount</h2>
                  <form @submit.prevent="updateDiscount">

                      <div v-if="updatedDiscount.type == 'none'">
                      <label for="customer_id">Customer:</label>
                      <select  v-model="updatedDiscount.customer_ids" class="selectItem">
                        <option value="all">All Customers</option>
                        <option v-for="customer in customers" :value="customer.id" :key="customer.id">
                          {{customer.id}} | {{customer.name}}
                        </option>
                      </select>
                      </div>

                      <label for="product_id">Product:</label>
                      <select v-model="updatedDiscount.product_ids" class="selectItem">
                        <option value="all">All products</option>
                        <option v-for="product in products" :value="product.id" :key="product.id">
                          {{product.id}} | {{product.name}} | {{product.price}}€
                        </option>
                      </select>

                      <label for="amount">Amount (%):</label>
                      <input type="number" v-model="updatedDiscount.amount" required>

                      <div v-if="updatedDiscount.type == 'sales'">
                        <label for="sales">Sales (€):</label>
                        <input type="number" v-model="updatedDiscount.sales" required>
                      </div>

                      <div v-if="updatedDiscount.type == 'season'">
                        <label for="start_date">Start date:</label>
                        <input type="date" v-model="updatedDiscount.start_date" required>
                      </div>

                      <div v-if="updatedDiscount.type == 'season'">
                        <label for="end_date">End date:</label>
                        <input type="date" v-model="updatedDiscount.end_date" required>
                      </div>

                      <button class="close" @click="closeUpdateForm">Close</button>
                      <button type="submit">Update</button>
                  </form>
              </div>
          </div>
          <tr>
            <th>Discount Id</th>
            <th>Type</th>
            <th>Customer</th>
            <th>Product</th>
            <th>Amount (%)</th>
            <th>Sales (€)</th>
            <th>Start date</th>
            <th>End date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="discount in discounts" :key="discount.id">
            <td>{{ discount.id }}</td>
            <td>{{ discount.type }}</td>
            <td>{{ discount.customer_ids }}</td>
            <td>{{ discount.product_ids }}</td>
            <td>{{ discount.amount }}</td>
            <td>{{ discount.sales }}</td>
            <td>{{ discount.start_date }}</td>
            <td>{{ discount.end_date }}</td>
            <button @click="openForm(discount)">Update</button>
            <button @click="confirmDelete(discount.id)">Delete</button>
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
            discounts: [],
            showUpdateForm: false,
            updatedDiscount: {
              id: 0,
              type: '',
              customer_id: '',
              product_id: '',
              amount: 1,
              sales: null,
              start_date: null,
              end_date: null,
            },
        }
    },
    watch: { 
        products: function(newVal, oldVal) {
            console.log('Data changed: ', oldVal.length, ' --> ', newVal.length)
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
      async fetchData() {
        try {
          const resp = await axios.get('http://localhost:8080/discounts');
          console.log(resp);
          this.discounts = resp.data;
          this.discounts.forEach(di => {
            if (di.customer_ids.length > 36) di.customer_ids = "all"
            if (di.product_ids.length > 36) di.product_ids = "all"
          });
        } catch (error) {
          console.error('Error fetching data:', error);
        };
      },
      openForm(discount) {
        this.updatedDiscount = { ...discount };
        this.showUpdateForm = true;
      },
      closeUpdateForm() {
        this.showUpdateForm = false;
      },
      async updateDiscount() {
        if (this.updatedDiscount.type == 'none') {
          this.updatedDiscount.sales = null;
          this.updatedDiscount.start_date = null;
          this.updatedDiscount.end_date = null;
        }
        else if (this.updatedDiscount.type == 'season') {
          this.updatedDiscount.sales = null;
        }
        else if (this.updatedDiscount.type == 'sales') {
          this.updatedDiscount.start_date = null;
          this.updatedDiscount.end_date = null;
        }

        if (this.updatedDiscount.customer_ids == 'all') {
          this.updatedDiscount.customer_ids = (customers.map(obj => obj.id)).toString();
        } else {
          this.updatedDiscount.customer_ids = ([this.updatedDiscount.customer_ids]).toString();
        }

        if (this.updatedDiscount.product_ids == 'all') {
          this.updatedDiscount.product_ids = (products.map(obj => obj.id)).toString();
        } else {
          this.updatedDiscount.product_ids = ([this.updatedDiscount.product_ids]).toString();
        }

        try {
          await axios.put(`http://localhost:8080/discounts/${this.updatedDiscount.id}`, this.updatedDiscount, {withCredentials: true});
          console.log('Discount updated successfully');
          this.showUpdateForm = false;
          this.fetchData();
          this.closeUpdateForm();
        } catch (error) {
          console.error('Error updating discount:', error);
        }
        this.emptyDiscount();
      },
      emptyDiscount() {
        this.updatedDiscount.id = 0;
        this.updatedDiscount.customer_ids= 'all';
        this.updatedDiscount.product_ids= 'all';
        this.updatedDiscount.amount= 1;
        this.updatedDiscount.sales= 1;
        this.updatedDiscount.type= 'none';
        this.updatedDiscount.amount_type= 'percent';
        this.updatedDiscount.start_date= null;
        this.updatedDiscount.end_date= null;
      },
      async confirmDelete(discountId) {
        const userConfirmed = window.confirm('Are you sure you want to delete this discount?');

        if (userConfirmed) {
          await this.delete(discountId);
        }
      },
      async delete(discountId) {
        console.log(discountId);
        try {
          await axios.delete(`http://localhost:8080/discounts/${discountId}`, {withCredentials: true});
          console.log('Discount deleted successfully');
          this.fetchData();
        } catch (error) {
          console.error('Error deleting discount:', error);
        }
      },
    },
};
</script>