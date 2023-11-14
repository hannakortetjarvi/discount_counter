<script setup>
import PricesTable from '../components/PricesTable.vue'
</script>

<template>
  <main class="prices">
    <div class="table">
    <p>Prices</p>
    <select v-model="selected" class="selectItem">
      <option value="all" key=all>All Customers</option>
      <option v-for="customer in customers" :value="customer.id" :key=customer.id>
		    {{ customer.name }} | {{ customer.id }}
	    </option>
    </select>
    <PricesTable :customer_id="selected" />
    </div>
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

<style>

.prices {
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