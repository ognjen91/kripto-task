import { createStore } from 'vuex'
import coins from './Coins.js'
import alerts from './Alerts.js'
import auth from './Auth.js'


export const store = createStore({
  modules : {
    coins,
    alerts,
    auth
  },

  state () {
    return {
    }
  },

  getters : {

  },

  mutations: {

  }
})
