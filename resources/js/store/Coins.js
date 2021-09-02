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
    alertsForCoinWithId : state => (coinId) => state.alerts[coinId] || [],
    getTheAlert : state => (coinId, alertId) => {
      if(!Object.keys(state.alerts).includes(coinId)) return null;
      let alert = state.alerts[coinId].find(alert => alert.id == alertId)
      return typeof alert !== 'undefined'? alert : null
    }
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

    REMOVE_ALERT : (state, payload) => {
      let alertsOfTheCoin = state.alerts[payload.coinId] || []
      let index = alertsOfTheCoin.findIndex(alert => alert.id == payload.id)
      if (index > -1) alertsOfTheCoin.splice(index, 1);
      state.alerts[payload.coinId] = alertsOfTheCoin
    }

  },

  actions: {
    async setCoinsData (context, payload) {

      axios.get(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&&?order=market_cap_asc&&per_page=${payload.perPage}&&page=1`)
        .then(function ({data}) {
          context.commit('SET_ALL_COINS', data)
        })
        .catch(function (error) {
          console.log(error)
          
          setTimeout(()=>{
            location.reload();
          }, 2000)
        })
      },
      
      async getAlertsForCoinWithId (context, payload) {
        axios.get(`/api/user/alerts/${payload.coinId}`)
        .then(({data}) => {
          // handle success
          context.commit('SET_ALERTS_FOR_COIN_WITH_ID', {
            coinId : payload.coinId,
            alerts : [...data.coinPriceAlerts]
          })
        // this.usersCoinPriceAlerts = [...data.coinPriceAlerts]
      })
      .catch(function (error) {
          // handle error
          console.log(error);
      })
    },

    async addNewAlert(context, payload){
      axios.post(`/api/user/alerts`, {
        coin_id : payload.coinId,
        target_price : payload.targetPrice,
        price_on_set_date : payload.priceOnSetDate,
        percentage_range : payload.percentageRange,
        note : payload.note
      })
      .then(({data}) => {
        // handle success
        // before commiting, need to add id of newly created record, so that router link on index page could receive all necesatly params
        payload.id = data.id
        context.commit('ADD_NEW_ALERT_FOR_COIN', payload)
      // this.usersCoinPriceAlerts = [...data.coinPriceAlerts]
      })
      .catch(function (error) {
          // handle error
          console.log(error);
      })
    },

    async deleteAlert(context, payload){
      // axios.delete(`/api/user/alerts/${payload.id}`)
      axios.delete(`/api/user/alerts`, {params: {'id': payload.id}})
      .then(({data}) => {
        // handle success
        context.commit('REMOVE_ALERT', payload)
      })
      .catch(function (error) {
          // handle error
          console.log(error);
      })
    },


  }

}
