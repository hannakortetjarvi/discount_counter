<template>
    <table>
        <thead>
          <tr>
            <th>Discount Name</th>
            <th>Discount Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="discount in filteredDiscounts" :key="discount.id">
            <td>{{ discount.name }}</td>
            <td>{{ discount.amount }}</td>
          </tr>
        </tbody>
      </table>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      discounts: []
    }
  },
  watch: { 
        type: function(newVal, oldVal) {
          console.log('Prop changed: ', oldVal, ' --> ', newVal)
        }
  }
};
</script>