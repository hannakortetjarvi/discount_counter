<script setup>
import CustomersTable from '../components/CustomersTable.vue'
import ProductsTable from '../components/ProductsTable.vue'
</script>

<template>
  <div class="data">
    <p>Data</p>
    <select v-model="selected" class="selectItem">
      <option value="customers" key=all>Customers</option>
      <option value="products" key=all>Products</option>
      <option value="discounts" key=all>Discounts</option>
    </select>

    <CustomersTable v-if="selected == 'customers'" />
    <ProductsTable v-if="selected == 'products'" />
  </div>
</template>

<script>
import customers from '../../data/customers.json'
import products from '../../data/products.json'

export default {
  data() {
    return {
      customers: customers,
      products: products,
      discounts: [],
      selected: 'customers'
    }
  }
};
</script>

<style>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
