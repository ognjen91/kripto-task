<template>
    <div class='home container'>
        <div class="row">

            <div class="w-full">
                <h1 class=''>Criptocurrency Prices</h1>
            </div>

            <!-- INDEX TABLE -->
            <div class="col-12 flex justify-center">
                <table class="w-full bg-white" v-if="coins.length">
                <thead class='text-right'>
                    <tr>
                        <th class='text-left pl-5' @click="orderByPriceChangePercentage24h = false">Currency</th>
                        <th>Price</th>
                        <th class=' change24 flex h-full items-center' @click='orderBy24hChange'><IconArrow :class="{'asc' : order =='DESC'}" /> Change 24h</th>
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
import IconArrow from '@/components/includes/icons/IconArrow'
export default {
    components : {
        IndexTableRow,
        IconArrow
    },

    data(){
        return {
            order : 'DESC',
            orderByPriceChangePercentage24h : false
        }
    },

    computed : {
        coins(){
            let coins = this.$store.getters['coins/allCoins']
            if(!this.orderByPriceChangePercentage24h) return coins
            let coinsSortCopy = [...coins]
            return this.order == 'DESC'? coins.sort((a, b) => (+a.price_change_percentage_24h > +b.price_change_percentage_24h) ? 1 : -1) : coinsSortCopy.sort((a, b) => (+a.price_change_percentage_24h < +b.price_change_percentage_24h) ? 1 : -1)
        }
    },

    methods : {
        orderBy24hChange(){
            this.orderByPriceChangePercentage24h = true
            this.order = this.order == 'ASC'? 'DESC' : 'ASC'
        }
    }



}
</script>