<template>
    <div>
        <Header />
                <h1 class='idsOfCoinsWithAlerts'>{{idsOfCoinsWithAlerts}}</h1>
            <main class='container'>
                <router-view></router-view>
            </main>
        <Footer />
    </div>
</template>

<script>
import Header from '@/components/includes/Header'
import Footer from '@/components/includes/Footer'

export default {
    components : {
        Header,
        Footer
    },

    data(){
        return {
            perPage : 20,
            echo : null
        }
    },

    computed : {
        idsOfCoinsWithAlerts(){
            return this.$store.getters['coins/idsOfCoinsWithAlerts']
        }
    },

    async created(){
        await this.$store.dispatch('coins/setCoinsData', {perPage : this.perPage})
        this.$store.dispatch('coins/getAlerts')

        // LISTEN FOR CHANGES AND UPDATE DATA IN VUEX
        window.Echo.channel('coin-price-changed')
        .listen('CoinPriceChanged', (e) => {
            this.$store.commit('coins/UPDATE_COIN_PRICE', {
                coinId : e.coinId,
                currentPrice : e.currentPrice,
                priceChangePercentage24h : e.priceChangePercentage24h
            })
            console.log(`${e.coinId} ${e.previousPrice} ${e.currentPrice} ${e.priceChangePercentage24h}`)
        });

        // let coinId;
        // let currentPrice;
        // LISTEN FOR CHANGES AND SHOW NOTIFICATION
        let coinId = 'bitcoin'




        window.Echo.private(`alert.${coinId}`)
        .listen('CoinPriceChanged', (e) => {
            console.log(`alert...alert... ${e.coinId} ${e.currentPrice}`)
        });
        
    }
}
</script>