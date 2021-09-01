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
                        <th>Currency</th>
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
            coins : [],
            perPage : 2
        }
    },


    async mounted(){
        const response = await axios.get(
        `https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&&?order=market_cap_asc&&per_page=${this.perPage}&&page=1`
        );
        // const data = response.data;
        this.coins = [...response.data]
        // console.log(data)
    }
}
</script>