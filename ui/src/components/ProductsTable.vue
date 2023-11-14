<template>
  <table>
    <thead>
      <tr>
        <th>Product Id</th>
        <th>Product Name</th>
        <th>Product Price (€)</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="product in products" :key="product.id">
        <td>{{ product.id }}</td>
        <td>{{ product.name }}</td>
        <td>{{ product.price }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import products from '../../data/products.json'

export default {
  data() {
    return {
      products: products
    }
  },
  watch: { 
    products: function(newVal, oldVal) {
      console.log('Data changed: ', oldVal.length, ' --> ', newVal.length)
    }
  }
};
</script>
