<script setup>
import DataTable from '../components/DataTable.vue'
import InfoQuery from '../components/InfoQuery.vue'
</script>

<template>
  <main>
    <select v-model="selected" class="selectItem">
        <option v-for="option in options" :value="option.value" :key=option.value>
		      {{ option.text }}
	      </option>
      </select>

    <InfoQuery :type=selected />

    <DataTable :type=selected />
  </main>
</template>

<script>
export default {
  data() {
    return {
      discounts: [],
      selected: 'sales',
      options: [
        {value: 'sales', text: 'Customer sales'},
        {value: 'season', text: 'Time of the year'},
        {value: 'deals', text: 'Special deals'}]
    }
  },
  computed: {
    filteredDiscounts() {
      switch (this.selected) {
        case 'sales':
          return this.discounts.filter((discount) => discount.type === 'sales');
        case 'season':
          return this.discounts.filter((discount) => discount.type === 'season');
        case 'deals':
          return this.discounts.filter((discount) => discount.type === 'deals');
        default:
          return [];
      }
    },
  },
  mounted() {
    // Fetch data
  },
};
</script>