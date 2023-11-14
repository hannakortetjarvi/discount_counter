<template>
    <table>
        <thead>
          <tr>
            <th>Customer Name</th>
            <th>Customer Id</th>
            <th>Product Name</th>
            <th>Product Id</th>
            <th>Discounted Price (€)</th>
            <th>Original Price (€)</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="price in prices" :key="price.product_id">
            <td>{{ customers.find(c => c.id == price.customer_id).name }}</td>
            <td>{{ price.customer_id }}</td>
            <td>{{ price.id }}</td>
            <td>{{ price.name }}</td>
            <td>{{ price.price }}</td>
            <td>{{ products.find(p => p.id == price.id).price }}</td>
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
            products: products,
            customers: customers,
        }
    },
    mounted() {
        this.initFetch();
    },
    watch: { 
        customer_id: function(newVal, oldVal) {
            console.log('Customer_id changes: ', oldVal, ' --> ', newVal);
            this.initFetch();
        },
        prices: function(newVal, oldVal) {
            console.log('Update prices', oldVal, ' --> ', newVal);
        },
    },
    methods: {
        async initFetch() {
            if (this.customer_id == 'all') {
                await this.fetchPricesForAll();
            } else {
                await this.fetchPricesForOne();
            }
        },
        async fetchPricesForOne() {
            try {
                this.prices = []
                const resp = await axios.get(`http://localhost:8080/prices/${this.customer_id}`);
                this.calculatePrices(this.customer_id, resp.data.discounts, resp.data.sales);
            } catch (error) {
                console.error('Error fetching data:', error);
            };
        },
        async fetchPricesForAll() {
            try {
                this.prices = []
                const resp = await axios.get('http://localhost:8080/prices');
                customers.forEach(c => {
                    const includedDiscounts = (resp.data.length == 0) ? [] : resp.data.discounts.filter(d => d.customer_ids.includes(c.id));
                    const includedSales = (resp.data.length == 0) ? [] : resp.data.sales.filter(s => s.customer_id.includes(c.id));
                    this.calculatePrices(c.id, includedDiscounts, includedSales);
                })
            } catch (error) {
                console.error('Error fetching data:', error);
            };
        },
        calculatePrices(id, disData, saleData) {
            let initPrices = JSON.parse(JSON.stringify(this.products));
            initPrices.forEach(p => {
                p['customer_id'] = id;
            });

            if (disData.length == 0) {this.prices.push(...initPrices); return 0;}
            const today = new Date();

            initPrices.forEach(price => {
                const included = disData.filter(d => d.product_ids.includes(price.id))
                included.forEach(dis => {
                    console.log(dis);
                    if (dis.type == 'none') {
                        price.price = parseFloat(price.price) - (parseFloat(price.price) * (parseFloat(dis.amount) / 100.00));
                    }
                    else if (dis.type == 'season') {
                        const d_start = Date.parse(dis.start_date);
                        const d_end = Date.parse(dis.end_date);
                        if (d_start <= today && today <= d_end) {
                            price.price = parseFloat(price.price) - (parseFloat(price.price) * (parseFloat(dis.amount) / 100.00));
                        }
                    }
                    else {
                        const l1 = dis.product_ids.length;
                        let sum = 0;
                        if (l1 > price.id) {
                            saleData.forEach(sale => {
                                const priceSale = parseFloat(this.products.find(p => p.id == sale.product_id).price);
                                sum += priceSale * parseFloat(sale.count);
                            })
                        }
                        else {
                            saleData.filter(s => s.product_id == dis.product_ids).forEach(sale => {
                                const priceSale = parseFloat(this.products.find(p => p.id == sale.product_id).price);
                                sum += priceSale * parseFloat(sale.count);
                            })
                        }
                        if (sum >= dis.sales) {
                            price.price = (parseFloat(price.price) - (parseFloat(price.price) * (parseFloat(dis.amount) / 100.00))).toFixed(2);
                        }
                    }
                });

                this.prices.push({ ...price });
            });
        },
    },
};
</script>