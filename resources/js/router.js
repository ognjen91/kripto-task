import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/components/pages/Home.vue'
import SingleCurrency from '@/components/pages/SingleCurrency.vue'
import CoinPriceAlertDetail from '@/components/pages/CoinPriceAlertDetail.vue'

const routerHistory = createWebHistory()

const router = createRouter({
  history: routerHistory,
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/currency/:id',
      name: 'single-currency',
      component: SingleCurrency,
      children: [
        {
          path: 'alerts/:alertId',
          name: 'alert-details',
          component: CoinPriceAlertDetail
        }
      ]
    },
  ]
})


export default router