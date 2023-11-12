<template>
    <table>
        <thead>
          <tr>
            <th>Product Id</th>
            <th>Product Name</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="price in prices" :key="price.product_id">
            <td>{{ price.product_id }}</td>
            <td>{{ price.product_name }}</td>
            <td>{{ price.price }}</td>
          </tr>
        </tbody>
      </table>
</template>

<script>
import axios from 'axios'
import products from '../../data/products.json'
import customers from '../../data/customers.json'

export default {
    props: ['customer_id'],
    data() {
        return {
            prices: [],
        }
    },
    mounted() {
        if (this.customer_id == 'all') {
            this.fetchPricesForAll();
        } else {
            this.fetchPricesForOne();
        }
    },
    watch: { 
        selected: function(newVal, oldVal) {
            console.log('Name changed: ', oldVal, ' --> ', newVal)
        }
    },
    methods: {
        async fetchPricesForOne() {
            try {
                const resp = await axios.get('http://localhost:8080/prices/${this.customer_id}');
                console.log(resp);
                this.calculatePrices(resp.data.data);
            } catch (error) {
                console.error('Error fetching data:', error);
            };
        },
        async fetchPricesForAll() {
            try {
                const resp = await axios.get('http://localhost:8080/prices');
                console.log(resp);
                this.prices = resp.data.data;
            } catch (error) {
                console.error('Error fetching data:', error);
            };
        },
        calculatePrices(data) {
            const initPrices = JSON.parse(JSON.stringify(products)); // Deep copy products
            const today = new Date();

            const result = {};

            data.discounts.forEach(discount => {
                const product = initPrices.find(p => p.product_id === discount.product_id);

                if (product) {
                    if (!result[discount.customer_id]) {
                        result[discount.customer_id] = {
                            customer_id: discount.customer_id,
                            discounts: [],
                        };
                    }

                if (discount.type === 'none') {
                    product.price -= product.price * (discount.amount / 100);
                } else if (discount.type === 'sales') {
                    const sale = data.sales.find(s => s.product_id === discount.product_id);
                    if (sale) {
                        product.price = sale.count * (product.price - (product.price * (discount.amount / 100)));
                    }
                } else if (discount.type === 'season') {
                    const startDate = new Date(discount.start_date);
                    const endDate = new Date(discount.end_date);

                    if (today >= startDate && today <= endDate) {
                        product.price -= product.price * (discount.amount / 100);
                    }
                }

                result[discount.customer_id].discounts.push({
                    product_id: discount.product_id,
                    discount_type: discount.type,
                    discount_amount: discount.amount,
                });
                }
            });

            this.prices = Object.values(result);
        },
    },
};
</script>