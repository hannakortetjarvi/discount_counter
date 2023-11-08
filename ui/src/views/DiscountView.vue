<script setup>
import DataTable from '../components/DataTable.vue'
import InfoQuery from '../components/InfoQuery.vue'
</script>

<template>
  <main>
    <select v-model="selected" class="selectItem">
      <option value="all" key=all>All Customers</option>
      <option v-for="customer in customers" :value="customer.name" :key=customer.id>
		    {{ customer.name }}
	    </option>
    </select>

    <DataTable :type=selected />
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