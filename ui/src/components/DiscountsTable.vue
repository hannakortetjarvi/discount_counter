<template>
    <table>
        <thead>
          <tr>
            <th>Discount Id</th>
            <th>Customer Id</th>
            <th>Product Id</th>
            <th>Type</th>
            <th>Amount (%)</th>
            <th>Start date</th>
            <th>End date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="discount in discounts" :key="discount.id">
            <td>{{ discount.id }}</td>
            <td>{{ discount.customer_id }}</td>
            <td>{{ discount.product_id }}</td>
            <td>{{ discount.type}}</td>
            <td>{{ discount.amount}}</td>
            <td>{{ discount.start_date}}</td>
          </tr>
        </tbody>
      </table>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            discounts: []
        }
    },
    watch: { 
        products: function(newVal, oldVal) {
            console.log('Data changed: ', oldVal.length, ' --> ', newVal.length)
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
      async fetchData() {
        try {
          const resp = await axios.get('http://localhost:8080/discounts');
          console.log(resp);
          this.sales = resp.data.data;
        } catch (error) {
          console.error('Error fetching data:', error);
        };
      },
    },
};
</script>