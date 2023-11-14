<template>
  <table>
    <thead>
      <tr>
        <th>Customer Id</th>
        <th>Customer Name</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="customer in customers" :key="customer.id">
        <td>{{ customer.id }}</td>
        <td>{{ customer.name }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import customers from '../../data/customers.json'

export default {
  data() {
    return {
      customers: customers
    }
  },
  watch: { 
    customers: function(newVal, oldVal) {
      console.log('Data changed: ', oldVal.length, ' --> ', newVal.length)
    }
  }
};
</script>
