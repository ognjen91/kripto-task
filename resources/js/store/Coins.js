import axios from 'axios'
import moment from 'moment';

export default {
  namespaced: true,

  state : {
    allCoins : [],
    alerts : {}
  },

  getters : {
    allCoins : state => state.allCoins,
    getTheCoin : state => (id) => state.allCoins.find(coin => coin.id == id),
  },

  mutations : {

    SET_ALL_COINS : (state, payload) => {
      state.allCoins = [...payload]
    },

    SET_ALERTS_FOR_COIN_WITH_ID : (state, payload) => {
      state.alerts[payload.coinId] = [...payload.alerts]
    },

    ADD_NEW_ALERT_FOR_COIN : (state, payload) => {
      // let coinAlreadyHasAlerts = Object.keys(state.alerts).includes(payload.coinId)
      let oldAlerts = state.alerts[payload.coinId] || []
      let updatedAlertsForTheCoin = [{
        ...payload, 
        createdAt : moment().format('DD MMM YYYY HH:mm') 
      }, ...oldAlerts] //new and old alerts. Payload is pased just like it is in vue component dispatch
      state.alerts[payload.coinId] = updatedAlertsForTheCoin //this way, the change will be visible via computed property
    },

    UPDATE_COIN_PRICE : (state, payload) => {
      let allCoins = [...state.allCoins]
      let theCoinIndex = allCoins.findIndex(coin => coin.id == payload.coinId)
      if(theCoinIndex == -1) return


      // update price and percentage now
      allCoins[theCoinIndex]['current_price'] = payload.currentPrice
      allCoins[theCoinIndex]['current_price'] = payload.currentPrice
      // assign array to state
      state.allCoins = allCoins
    }

  },

  actions: {
    async setCoinsData (context, payload) {

      // axios.get(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&&?order=market_cap_asc&&per_page=${payload.perPage}&&page=1`)
      axios.get(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&order=market_cap_desc&per_page=${payload.perPage}&page=1&sparkline=false&price_change_percentage=7d`)
        .then(function ({data}) {
          context.commit('SET_ALL_COINS', data)
        })
        .catch(function (error) {
          toastr["error"]("Error!", "Can't establish connection to Coingecko API")
          
          setTimeout(()=>{
            location.reload();
          }, 2000)
        })
      },


  }

}
