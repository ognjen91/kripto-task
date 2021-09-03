import axios from 'axios'
import moment from 'moment';

export default {
  namespaced: true,

  state : {
    user : null
  },

  getters : {
    userIsLogged : state => !!state.user
  },

  mutations : {

    SET_USER : (state, payload) => {
      state.user = payload
    },


  },

  actions: {
    async logIn (context, payload) {

      // axios.get(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&&?order=market_cap_asc&&per_page=${payload.perPage}&&page=1`)
      axios.get(`/api/user`)
        .then(function (response) {
          if(response.status === 200){
              context.commit('SET_USER', response.data)
          }
        })
      },


  }

}