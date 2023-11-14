<script setup>
import CustomersTable from '../components/CustomersTable.vue'
import ProductsTable from '../components/ProductsTable.vue'
import SalesTable from '../components/SalesTable.vue'
import DiscountsTable from '../components/DiscountsTable.vue'
</script>

<template>
  <div class="data">
    <p>Shown data:</p>
    <select v-model="selected" class="selectItem">
      <option value="customers" key=customers>Customers</option>
      <option value="products" key=products>Products</option>
      <option value="sales" key=sales>Sales</option>
      <option value="discounts" key=discounts>Discounts</option>
    </select>
    <div class="table">
      <CustomersTable v-if="selected == 'customers'" />
      <ProductsTable v-if="selected == 'products'" />
      <SalesTable v-if="selected == 'sales'" />
      <DiscountsTable v-if="selected == 'discounts'" />
    </div>
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
.data {
  margin-top: 5em;
}

select {
  margin-bottom: 1em;
  width: 50%;
}

.table {
  width: 1200px;
}
</style>
