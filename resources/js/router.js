import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/components/pages/Home.vue'
import SingleCurrency from '@/components/pages/SingleCurrency.vue'
import CoinPriceAlertDetail from '@/components/pages/CoinPriceAlertDetail.vue'
import CreateNewCoinPriceAlert from '@/components/pages/CreateNewCoinPriceAlert.vue'

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
          path: 'alerts/create',
          name: 'alert-create',
          component: CreateNewCoinPriceAlert
        },
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