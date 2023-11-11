<script setup>
import CustomersTable from '../components/CustomersTable.vue'
import ProductsTable from '../components/ProductsTable.vue'
import SalesTable from '../components/SalesTable.vue'
</script>

<template>
  <div class="data">
    <p>Data</p>
    <select v-model="selected" class="selectItem">
      <option value="customers" key=all>Customers</option>
      <option value="products" key=all>Products</option>
      <option value="sales" key=all>Sales</option>
    </select>

    <CustomersTable v-if="selected == 'customers'" />
    <ProductsTable v-if="selected == 'products'" />
    <SalesTable v-if="selected == 'sales'" />
  </div>
</template>

<script>
export default {
  data() {
    return {
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
