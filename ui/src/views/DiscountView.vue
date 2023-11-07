<script setup>
import TheWelcome from '../components/TheWelcome.vue'

const options = [
  {value: 'sales', text: 'Customer sales'},
  {value: 'season', text: 'Time of the year'},
  {value: 'deals', text: 'Special deals'}
]
const selected = 'sales'
</script>

<template>
  <main>
    <select v-model="selected">
        <option v-for="option in options" :value="option.value">
		      {{ option.text }}
	      </option>
      </select>
    <TheWelcome />
  </main>
</template>
