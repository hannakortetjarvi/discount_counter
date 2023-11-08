<script setup>
import DiscountTable from '../components/DiscountTable.vue'
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

    <DiscountTable :type=selected />
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