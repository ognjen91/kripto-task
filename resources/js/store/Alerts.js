import axios from 'axios'
import moment from 'moment';
import toastr from 'toastr'

export default {
  namespaced: true,

  state : {
    alerts : {}
  },

  getters : {
    alertsForCoinWithId : state => (coinId) => state.alerts[coinId] || [],
    allAlerts : state => state.alerts,
    idsOfCoinsWithAlerts : state => {
      let coinsThatMayHaveAlerts = Object.keys(state.alerts)
      //but as some keys may have empty arrays, return only these whose alerts are not empty
      let coinsWithAlerts = []
      for(let i=0; i<coinsThatMayHaveAlerts.length; i++){
        if(state.alerts[coinsThatMayHaveAlerts[i]].length) coinsWithAlerts.push(coinsThatMayHaveAlerts[i])
      }

      return coinsWithAlerts
    },
    getTheAlert : state => (coinId, alertId) => {
      if(!Object.keys(state.alerts).includes(coinId)) return null;
      let alert = state.alerts[coinId].find(alert => alert.id == alertId)
      return typeof alert !== 'undefined'? alert : null
    }
  },

  mutations : {

    SET_ALERTS_FOR_COIN_WITH_ID : (state, payload) => {
      state.alerts[payload.coinId] = [...payload.alerts]
    },

    ADD_NEW_ALERT_FOR_COIN : (state, payload) => {
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
    },

  },

  actions: {
      async getAlerts (context) {
        axios.get(`/api/user/alerts`)
        .then(({data}) => {
          // handle success
          for(let i in data.coinPriceAlerts){
            context.commit('ADD_NEW_ALERT_FOR_COIN', data.coinPriceAlerts[i])
          }

      })
      .catch(function (error) {
        toastr["error"]("Please try again", "An error happened")
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
        toastr["success"]("You will be notified when the price reaches the selected one", "Alert created successfully")
      })
      .catch(function (error) {
        toastr["error"]("Please try again", "An error happened")
      })
    },

    async deleteAlert(context, payload){
      axios.delete(`/api/user/alerts`, {params: {'id': payload.id}})
      .then(({data}) => {
        // handle success
        context.commit('REMOVE_ALERT', payload)
        toastr["info"]("You will no longer be notified", "Alert removed successfully")
      })
      .catch(function (error) {
        toastr["error"]("Please try again", "An error happened")
      })
    },


  }

}
