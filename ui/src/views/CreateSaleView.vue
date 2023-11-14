<template>
        <div class="sale-form">
            <h2>Add A New Sale</h2>
            <form @submit.prevent="createSale">
              <div class="form-div">
                <div>
                  Customer:
                <select v-model="newSale.customer_id" class="selectItem">
                    <option v-for="customer in customers" :value="customer.id" :key="customer.id">
                        {{customer.id}} | {{customer.name}}
                    </option>
                </select>
                </div>

                <div>
                  Product:
                <select v-model="newSale.product_id" class="selectItem">
                    <option v-for="product in products" :value="product.id" :key="product.id">
                        {{product.id}} | {{product.name}} | {{product.price}}€
                    </option>
                </select>
                </div>

                <div>
                <label for="count">Amount of Items Sold: </label>
                <input type="number" min="1" v-model="newSale.count" required>
                </div>

                <button type="submit">Add Sale</button>
              </div>
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
        if (this.newSale.customer_id == '') {
          this.$toast.error(`Missing Customer Id!`, {
            duration: 6000,
          });
          return 0;
        }
        if (this.newSale.product_id == '') {
          this.$toast.error(`Missing Product Id!`, {
            duration: 6000,
          });
          return 0;
        }
        if (this.newSale.count == undefined || this.newSale.count < 1) {
          this.$toast.error(`Amount of items sold needs to be atleast 1!`, {
            duration: 6000,
          });
          return 0;
        }

        if (!Number.isInteger(this.newSale.count)) {
          this.$toast.error(`Amount of items needs to be whole number!`, {
            duration: 6000,
          });
          return 0;
        }

        let loader = this.$loading.show({});
        try {
          await axios.post('http://localhost:8080/sales', this.newSale, {withCredentials: true,})
          loader.hide();
          this.$toast.success(`New Sale Added!`, {
            duration: 6000,
          });
        } catch (error) {
          this.$toast.error(`Error Occurred!`, {
            duration: 6000,
          });
        }
        this.newSale.customer_id = '';
        this.newSale.product_id = '';
        this.newSale.count = 1;
      },
    },
};
</script>

<style>

.sale-form {
  margin-top: 5em;
}

.form-div {
  display: grid;
  height: 100%;
  margin-top: 1em;
  gap: 6px;
}

.form-div div {
  width: 100%;
}

h2 {
  margin-bottom: 15px;
}

select {
  width: 100%;
}

button {
  margin-top: 10px;
}

</style>