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
                        <th class='text-left pl-5'>Currency</th>
                        <th class='border'>Price</th>
                        <th class='border change24 flex h-full items-center' @click='changeOrder' :class="{'asc' : order =='ASC'}"><IconArrow/> Change 24h</th>
                        <th class='border'>Market cap</th>
                        <th class='border'>Volume 24h</th>
                        <th class='border'>Price graph 7d</th>
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
            order : 'DESC'
        }
    },

    computed : {
        coins(){
            let coins = this.$store.getters['coins/allCoins']
            return this.order == 'DESC'? coins : coins.sort((a, b) => (+a.price_change_percentage_24h < +b.price_change_percentage_24h) ? 1 : -1)
        }
    },

    methods : {
        changeOrder(){
            this.order = this.order == 'ASC'? 'DESC' : 'ASC'
        }
    }



}
</script>