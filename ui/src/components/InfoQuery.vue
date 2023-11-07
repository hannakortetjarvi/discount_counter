<template>
    <p>Additional info needed</p>
    <input v-model="input">
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
      input: ''
    }
  },
  watch: { 
        input: function(newVal, oldVal) {
          console.log('Input changed: ', oldVal, ' --> ', newVal)
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