<template>
          <div v-if="showUpdateForm" class="discount-update">
            <h2>Update Discount</h2>
            <form @submit.prevent="updateDiscount">
                <div class="form-div">

                <div v-if="updatedDiscount.type == 'none'">
                  Customer(s):
                <select v-model="updatedDiscount.customer_ids" class="selectItem">
                    <option value="all">All Customers</option>
                    <option v-for="customer in customers" :value="customer.id" :key="customer.id">
                        {{customer.id}} | {{customer.name}}
                    </option>
                </select>
                </div>

                <div>
                  Product(s):
                <select v-model="updatedDiscount.product_ids" class="selectItem">
                    <option value="all">All products</option>
                    <option v-for="product in products" :value="product.id" :key="product.id">
                        {{product.id}} | {{product.name}} | {{product.price}}€
                    </option>
                </select>
                </div>

                <div>
                Amount of Discount:
                <input type="number" min="1" max="100" v-model="updatedDiscount.amount" required> %
                </div>

                <div v-if="updatedDiscount.type == 'season'">
                  Start date:
                <input  type="date" v-model="updatedDiscount.start_date">
                </div>
                
                <div v-if="updatedDiscount.type == 'season'">
                  End date:
                <input type="date" v-model="updatedDiscount.end_date">
                </div>

                <div v-if="updatedDiscount.type == 'sales'">
                  Amount of Sales:
                <input type="number" min="1" v-model="updatedDiscount.sales">€
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
              sales: 0,
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
        let loader = this.$loading.show({
                container: this.$refs.priceTable,
        });
        try {
          const resp = await axios.get('http://localhost:8080/discounts');
          console.log(resp);
          this.discounts = resp.data;
          this.discounts.forEach(di => {
            if (di.customer_ids.length > 36) di.customer_ids = "all";
            if (di.product_ids.length > 36) di.product_ids = "all";
            if (di.sales == 0) di.sales = null;
          });
        } catch (error) {
          console.error('Error fetching data:', error);
        };
        loader.hide();
      },
      openForm(discount) {
        this.updatedDiscount = { ...discount };
        this.showUpdateForm = true;
      },
      closeUpdateForm() {
        this.showUpdateForm = false;
      },
      async updateDiscount() {
        if (this.updatedDiscount.type == 'season' && this.updatedDiscount.start_date == null) {
          this.$toast.error(`Missing Start Date!`, {
            duration: 6000,
          });
          return 0;
        }
        if (this.updatedDiscount.type == 'season' && this.updatedDiscount.end_date == null) {
          this.$toast.error(`Missing End Date!`, {
            duration: 6000,
          });
          return 0;
        }
        if (this.updatedDiscount.amount == undefined || this.updatedDiscount.amount < 1) {
          this.$toast.error(`Discount amount needs to be atleast 1%!`, {
            duration: 6000,
          });
          return 0;
        }
        if (this.updatedDiscount.amount > 100) {
          this.$toast.error(`Discount amount needs to be smaller than 100%!`, {
            duration: 6000,
          });
          return 0;
        }
        if (this.updatedDiscount.type == 'sales' && (this.updatedDiscount.sales == undefined || this.updatedDiscount.amount < 1)) {
          this.$toast.error(`Discount amount needs to be atleast 1%!`, {
            duration: 6000,
          });
          return 0;
        }

        let loader = this.$loading.show({});
        if (this.updatedDiscount.type == 'none') {
          this.updatedDiscount.sales = 0;
          this.updatedDiscount.start_date = null;
          this.updatedDiscount.end_date = null;
        }
        else if (this.updatedDiscount.type == 'season') {
          this.updatedDiscount.sales = 0;
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

        this.updatedDiscount.amount.replace(",",".");
        this.updatedDiscount.sales.replace(",",".");

        try {
          await axios.put(`http://localhost:8080/discounts/${this.updatedDiscount.id}`, this.updatedDiscount, {withCredentials: true});
          this.showUpdateForm = false;
          this.fetchData();
          loader.hide();
          this.$toast.success(`Discount Updated!`, {
            duration: 6000,
          });
          this.closeUpdateForm();
        } catch (error) {
          this.$toast.error(`Error Occurred!`, {
            duration: 6000,
          });
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
        let loader = this.$loading.show({});
        try {
          await axios.delete(`http://localhost:8080/discounts/${discountId}`, {withCredentials: true});
          this.fetchData();
          loader.hide();
          this.$toast.success(`Discount Deleted!`, {
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

.discount-update {
  border: 1px dotted black;
  padding: 10px;
  margin-top: 1em;
  margin-bottom: 2em;
}

</style>