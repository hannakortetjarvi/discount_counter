<script setup>
import PricesTable from '../components/PricesTable.vue'
</script>

<template>
  <main>
    <p>Prices</p>
    <select v-model="selected" class="selectItem">
      <option value="all" key=all>All Customers</option>
      <option v-for="customer in customers" :value="customer.id" :key=customer.id>
		    {{ customer.name }}
	    </option>
    </select>

    <PricesTable :customer_id="selected" />
  </main>
</template>

<script>
import customers from '../../data/customers.json'

export default {
  data() {
    return {
      customers: customers,
      selected: 'all'
    }
  }
};
</script>