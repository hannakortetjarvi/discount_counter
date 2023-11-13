<template>
    <table>
        <thead>
          <div v-if="showUpdateForm" class="popup">
              <div class="popup-content">
                  <h2>Update Discount</h2>
                  <form @submit.prevent="updateDiscount">

                    <label for="customer_id">Customer ID:</label>
                    <input type="text" v-model="updatedDiscount.customer_id" required>

                      <label for="product_id">Product ID:</label>
                      <input type="text" v-model="updatedDiscount.product_id" required>

                      <label for="count">Count:</label>
                      <input type="number" v-model="updatedDiscount.count" required>

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
            <td>{{ discount.start_date }}</td>
            <td>{{ discount.end_date }}</td>
          </tr>
        </tbody>
      </table>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            discounts: [],
            showUpdateForm: false,
            updatedDiscount: {
              customer_id: '',
              product_id: '',
              count: 1,
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
          discounts.forEach(di => {
            if (di.customer_ids.length > 36) di.customer_ids = "All customers"
            if (di.product_ids.length > 36) di.product_ids = "All products"
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
        try {
          await axios.put('http://localhost:8080/discounts/${this.updatedDiscount.id}', this.updatedDiscount, {withCredentials: true});
          console.log('Discount updated successfully');
          this.showUpdateForm = false;
          this.fetchData();
          this.closeUpdateForm();
        } catch (error) {
          console.error('Error updating discount:', error);
        }
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
          await axios.delete('http://localhost:8080/discounts/${discountId}', {withCredentials: true});
          console.log('Discount deleted successfully');
          this.fetchData();
        } catch (error) {
          console.error('Error deleting discount:', error);
        }
      },
    },
};
</script>