<template>
    <div>
        <Header />
            <main class='w-full'>
                <router-view></router-view>
            </main>

            <CoinPriceAlertWindow
            v-for="(alert, i) in alerts"
            :key="'alert-'+i"
            :alert-key="i"
            :alert="alert"
            @close="removeAlert" 
            />
            <!-- passing the key which can be returned in close event ade we can use it for removing from array -->
            
        <Footer />
    </div>
</template>

<script>
import Header from '@/components/includes/Header'
import Footer from '@/components/includes/Footer'
import CoinPriceAlertWindow from '@/components/includes/CoinPriceAlertWindow'

export default {
    components : {
        Header,
        Footer,
        CoinPriceAlertWindow
    },

    data(){
        return {
            perPage : 5,
            echo : null,
            alerts : [
                // BLUEPRINT FOR DEV... Need to use  TS asap!!!
                // {
                // coinId : 'bitcoin',
                // currentPrice : '50000',
                // date : 'May 20 2021',
                // time : '22:15'
                // }
            ]
        }
    },

    computed : {
        idsOfCoinsWithAlerts(){
            return this.$store.getters['alerts/idsOfCoinsWithAlerts']
        },
        userIsLogged(){
            return this.$store.getters['auth/userIsLogged']
        }
    },

    methods : {
        removeAlert(alertKey){
            //remove from alerts array
            this.alerts.splice(alertKey, 1);
            //OTHER THAN THIS, IN THE FUTURE, WE CAN ADD MORE LOGIC HERE
        }
    },

    watch : {
        idsOfCoinsWithAlerts(newVal){
        // LISTEN FOR CHANGES AND SHOW NOTIFICATION
        for(let i in newVal){
                let coinId = newVal[i];
                window.Echo.private(`alert.${coinId}`)
                .listen('CoinPriceChanged', (e) => {
                    this.alerts = [...this.alerts, {
                        coinId : e.coinId,
                        currentPrice : e.currentPrice,
                        date : e.date,
                        time : e.time
                    }]

                    // console.log(`alert... ${e.coinId},${e.currentPrice},`)
                });

        }
        }
    },

    async created(){
        await this.$store.dispatch('coins/setCoinsData', {perPage : this.perPage})

        // LISTEN FOR CHANGES AND UPDATE DATA IN VUEX
        window.Echo.channel('coin-price-changed')
        .listen('CoinPriceChanged', (e) => {
            this.$store.commit('coins/UPDATE_COIN_PRICE', {
                coinId : e.coinId,
                currentPrice : e.currentPrice,
                priceChangePercentage24h : e.priceChangePercentage24h
            })
            // console.log(`${e.coinId} ${e.previousPrice} ${e.currentPrice} ${e.priceChangePercentage24h}`)
        });

        await this.$store.dispatch('auth/logIn') //await so we could get list of coins with alerts
        // GET ALERTS IF USER IS LOGGED
        this.$store.dispatch('alerts/getAlerts') //await so we could get list of coins with alerts
    }
}
</script>