<script setup>
import DiscountsTable from '../components/DiscountsTable.vue'
import PricesTable from '../components/PricesTable.vue'
</script>

<template>
  <main>
    <p>Discounts</p>
    <select v-model="selected" class="selectItem">
      <option value="all" key=all>All Customers</option>
      <option v-for="customer in customers" :value="customer.name" :key=customer.id>
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