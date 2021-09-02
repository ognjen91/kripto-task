import axios from 'axios'

export default {
  namespaced: true,

  state : {
    allCoins : [],
  },

  getters : {
    allCoins : state => state.allCoins,
  },

  mutations : {

    SET_ALL_COINS : (state, payload) => {
      state.allCoins = [...payload]
    },

  },

  actions: {
    async setCoinsData (context, payload) {

      axios.get(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&&?order=market_cap_asc&&per_page=${payload.perPage}&&page=1`)
        .then(function ({data}) {
          context.commit('SET_ALL_COINS', data)
        })
        .catch(function (error) {
          console.log(error)

          setTimeout(()=>{
            location.reload();
          }, 2000)
        })

      // axios.get('https://api.covid19api.com/summary')
      //   .then(function ({data}) {
      //     context.commit('SET_TOTAL_DATA', {
      //       TotalConfirmed : data.Global.TotalConfirmed,
      //       NewConfirmed : data.Global.NewConfirmed,
      //       NewDeaths : data.Global.NewDeaths,
      //       TotalDeaths : data.Global.TotalDeaths,
      //       NewRecovered : data.Global.NewRecovered,
      //       TotalRecovered : data.Global.TotalRecovered,
      //       updateTime : data.Date
      //     })

      //     //set countries, but remove fake ones
      //     context.commit('countries/SET_COUNTRIES_DATA', data.Countries.filter(country => country.Slug !== 'kosovo'), { root: true })
      //   })
      //   .catch(function (error) {
      //     toastr["error"]("Error Receiving Data. Page will reload now.")

      //     setTimeout(()=>{
      //       location.reload();
      //     }, 2000)
      //   })
    }
  }

}
