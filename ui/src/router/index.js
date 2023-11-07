import { createRouter, createWebHistory } from 'vue-router'
import DiscountView from '../views/DiscountView.vue'
import DataView from '../views/DataView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/discounts',
      name: 'discounts',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: DiscountView
    },
    {
      path: '/',
      redirect: '/discounts'
    },
    {
      path: '/data',
      name: 'data',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: DataView
    }
  ]
})

export default router
