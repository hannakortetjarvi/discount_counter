<template>
  <div v-if="showUpdateForm" class="sale-update">
    <h2>Update Sale</h2>
    <form @submit.prevent="updateSale">
      <div class="form-div">
        <div>
          Customer:
          <select v-model="updatedSale.customer_id" class="selectItem">
            <option v-for="customer in customers" :value="customer.id" :key="customer.id">
              {{customer.id}} | {{customer.name}}
            </option>
          </select>
        </div>

        <div>
          Product:
          <select v-model="updatedSale.product_id" class="selectItem">
            <option v-for="product in products" :value="product.id" :key="product.id">
              {{product.id}} | {{product.name}} | {{product.price}}€
            </option>
          </select>
        </div>

        <div>
          <label for="count">Amount of Items Sold: </label>
          <input type="number" min="1" v-model="updatedSale.count" required>
        </div>

        <div>
          <button type="submit">Update</button>
          <button class="close" @click="closeUpdateForm">Close</button>
        </div>
      </div>
    </form>
  </div>

  <table>
    <thead>
      <tr>
        <th>Sale Id</th>
        <th>Customer Id</th>
        <th>Product Id</th>
        <th>Item Count</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="sale in sales" :key="sale.id">
        <td>{{ sale.id }}</td>
        <td>{{ sale.customer_id }}</td>
        <td>{{ sale.product_id }}</td>
        <td>{{ sale.count}}</td>
        <button @click="openForm(sale)">Update</button>
        <button @click="confirmDelete(sale.id)">Delete</button>
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
    // Collect sale data
    async fetchData() {
      let loader = this.$loading.show({});
      try {
        const resp = await axios.get('http://localhost:8080/sales');
        this.sales = resp.data;
      } catch (error) {
        console.error('Error fetching data:', error);
      };
      loader.hide();
    },
    // Open update form and set the sale to be updated
    openForm(sale) {
      this.updatedSale = { ...sale };
      this.showUpdateForm = true;
    },
    // Close update form
    closeUpdateForm() {
      this.showUpdateForm = false;
    },
    // Put sale into API if data is valid
    async updateSale() {
      // Check given values
      if (!Number.isInteger(this.updatedSale.count)) {
        this.$toast.error(`Amount of items needs to be whole number!`, {
          duration: 6000,
        });
        return 0;
      }
      if (this.updatedSale.customer_id == '') {
        this.$toast.error(`Missing Customer Id!`, {
          duration: 6000,
        });
        return 0;
      }
      if (this.updatedSale.product_id == '') {
        this.$toast.error(`Missing Product Id!`, {
          duration: 6000,
        });
        return 0;
      }
      if (this.updatedSale.count == undefined || this.updatedSale.count < 1) {
        this.$toast.error(`Amount of items sold needs to be atleast 1!`, {
          duration: 6000,
        });
        return 0;
      }

      // Show loader and put data into API
      let loader = this.$loading.show({});
      try {
        await axios.put(`http://localhost:8080/sales/${this.updatedSale.id}`, this.updatedSale, {withCredentials: true});
        this.showUpdateForm = false;
        this.fetchData();
        loader.hide();
        this.$toast.success(`Sale Updated!`, {
          duration: 6000,
        });
        
        // Close form and set sale to initial sale
        this.closeUpdateForm();
        this.updatedSale.id = 0,
        this.updatedSale.customer_id = '';
        this.updatedSale.product_id = '';
        this.updatedSale.count = 1;
      } catch (error) {
        loader.hide();
        this.$toast.error(`Error Occurred!`, {
          duration: 6000,
        });
      }
    },
    // Ask user if they want to delete discount
    async confirmDelete(saleId) {
      const input = window.confirm('Are you sure you want to delete this sale?');

      if (input) {
        await this.delete(saleId);
      }
    },
    // Delete discount through API
    async delete(saleId) {
      let loader = this.$loading.show({});
      try {
        await axios.delete(`http://localhost:8080/sales/${saleId}`, {withCredentials: true});
        this.fetchData();
        loader.hide();
        this.$toast.success(`Sale Deleted!`, {
          duration: 6000,
        });
      } catch (error) {
        loader.hide();
        this.$toast.error(`Error Occurred!`, {
          duration: 6000,
        });
      }
    },
  },
};
</script>

<style>

.close {
  margin-left: 5px;
}

.sale-update {
  border: 1px dotted black;
  padding: 10px;
  margin-top: 1em;
  margin-bottom: 2em;
}

</style>