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
    <DataTable :type=selected />
  </main>
</template>

<script>
export default {
  data() {
    return {
      discounts: [],
      selected: 'all',
      options: [
        {value: 'all', text: 'All Customers'}
      ]
    }
  },
  mounted() {
    // Fetch data
  },
};
</script>