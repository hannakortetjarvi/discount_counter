<template>
    <table>
        <thead>
          <tr>
            <th>Sale Id</th>
            <th>Customer Id</th>
            <th>Product Id</th>
            <th>Count (how many products)</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="sale in sales" :key="sale.id">
            <td>{{ sale.id }}</td>
            <td>{{ sale.customer_id }}</td>
            <td>{{ sale.product_id }}</td>
            <td>{{ sale.count}}</td>
          </tr>
        </tbody>
      </table>
</template>

<script>
export default {
    data() {
        return {
            sales: []
        }
    },
    watch: { 
        products: function(newVal, oldVal) {
            console.log('Data changed: ', oldVal.length, ' --> ', newVal.length)
        }
    }
    created(){
        fetchData() {
            fetch('https://localhost:8080/sales')
            .then(resp => resp.json())
            .then(json => this.posts = json.data)
            .catch((err) => {
                console.error(err);
            });
        },
    },
};
</script>