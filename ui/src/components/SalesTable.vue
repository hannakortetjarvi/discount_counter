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
      async fetchData() {
        let loader = this.$loading.show({});
        try {
          const resp = await axios.get('http://localhost:8080/sales');
          console.log(resp);
          this.sales = resp.data;
        } catch (error) {
          console.error('Error fetching data:', error);
        };
        loader.hide();
      },
      openForm(sale) {
        this.updatedSale = { ...sale };
        this.showUpdateForm = true;
      },
      closeUpdateForm() {
        this.showUpdateForm = false;
      },
      async updateSale() {
        if (!Number.isInteger(this.updatedSale.count)) {
          this.$toast.error(`Amount of items needs to be whole number!`, {
            duration: 6000,
          });
          return 0;
        }

        if (updatedSale.customer_id == '') {
          this.$toast.error(`Missing Customer Id!`, {
            duration: 6000,
          });
          return 0;
        }
        if (updatedSale.product_id == '') {
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

        let loader = this.$loading.show({});
        try {
          await axios.put(`http://localhost:8080/sales/${this.updatedSale.id}`, this.updatedSale, {withCredentials: true});
          this.showUpdateForm = false;
          this.fetchData();
          loader.hide();
          this.$toast.success(`Sale Updated!`, {
            duration: 6000,
          });
          this.closeUpdateForm();
          this.updatedSale.id = 0,
          this.updatedSale.customer_id = '';
          this.updatedSale.product_id = '';
          this.updatedSale.count = 1;
        } catch (error) {
          this.$toast.error(`Error Occurred!`, {
            duration: 6000,
          });
        }
      },
      async confirmDelete(saleId) {
        const userConfirmed = window.confirm('Are you sure you want to delete this sale?');

        if (userConfirmed) {
          await this.delete(saleId);
        }
      },
      async delete(saleId) {
        let loader = this.$loading.show({});
        console.log(saleId);
        try {
          await axios.delete(`http://localhost:8080/sales/${saleId}`, {withCredentials: true});
          this.fetchData();
          loader.hide();
          this.$toast.success(`Sale Deleted!`, {
            duration: 6000,
          });
        } catch (error) {
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