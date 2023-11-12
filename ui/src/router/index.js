import { createRouter, createWebHistory } from 'vue-router'
import PriceView from '../views/PriceView.vue'
import DataView from '../views/DataView.vue'
import CreateSaleView from '../views/CreateSaleView.vue'
import CreateDiscountView from '../views/CreateDiscountView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/prices',
      name: 'prices',
      component: PriceView
    },
    {
      path: '/',
      redirect: '/discounts'
    },
    {
      path: '/data',
      name: 'data',
      component: DataView
    },
    {
      path: '/create-discount',
      name: 'create-discount',
      component: CreateDiscountView
    },
    {
      path: '/create-sale',
      name: 'create-sale',
      component: CreateSaleView
    }
  ]
})

export default router
