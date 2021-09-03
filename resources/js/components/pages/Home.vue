<template>
    <div class='home container'>
        <div class="row">

            <div class="col-12">
                <h1 class='mb-9'>Criptocurrency Prices</h1>
            </div>

            <!-- INDEX TABLE -->
            <div class="col-12 flex justify-center">
                <table class="w-full bg-white" v-if="coins.length">
                <thead class='text-right'>
                    <tr>
                        <th class='text-left'>Currency</th>
                        <th>Price</th>
                        <th>Change 24h</th>
                        <th>Market cap</th>
                        <th>Volume 24h</th>
                        <th>Price graph 7d</th>
                    </tr>
                </thead>
                <tbody>
                    <IndexTableRow
                    v-for="(coin, i) in coins"
                    :key="'coin-'+i"
                    :coin="coin"
                    />
                </tbody>
                </table>
            </div>

        </div>
    </div>
</template>
<script>
import axios from 'axios'
import IndexTableRow from '@/components/includes/IndexTableRow'
export default {
    components : {
        IndexTableRow
    },

    data(){
        return {

        }
    },

    computed : {
        coins(){
            return this.$store.getters['coins/allCoins']
        }
    },

    // mounted(){
    //     window.Echo = new Echo({
    //     broadcaster: 'pusher',
    //     key: process.env.MIX_PUSHER_APP_KEY,
    //     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    //     forceTLS: true,
    //     encrypted: true
    //     });

    //     Echo.private('coin-price-changed')
    //     .listen('CoinPriceChanged', (e) => {
    //         console.log(`${e.coinId} ${e.previousPrice} ${e.currentPrice}`)
    //     });
    // }



}
</script>