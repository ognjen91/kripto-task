<template>
    <tr class='text-right'>
        <td class='text-left logo-and-name flex'>
            <img :src="coin.image" :alt="'logo of ' + coin.name" class="w-full">
            {{coin.name}} 
            <span class="uppercase ml-2">{{coin.symbol}}</span>
        </td>
        <td>{{coin.current_price}}</td>
        <td>{{coin.price_change_24h}}</td>
        <td>{{coin.market_cap}}</td>
        <td>???</td>
        <td class='seven-days-chart'><PriceChangeChart :data="lastWeekChanges" /></td>
    </tr>
</template>
<script>
import PriceChangeChart from '@/components/includes/PriceChangeChart'
export default {
    components : {
        PriceChangeChart
    },

    props : {
        coin : {
            Type : Object,
            required : true
        }
    },

    data(){
        return {
            lastWeekChanges : []
        }
    },

    async mounted(){
        let currentTimestamp = Math.round(+ (new Date()) / 1000)
        let sevenDaysAgoTimestamp = currentTimestamp - 7 * 24 * 3600
        // console.log(currentTimestamp, sevenDaysAgoTimestamp)

        const response = await axios.get(
        `https://api.coingecko.com/api/v3/coins/${this.coin.id}/market_chart/range?vs_currency=eur&from=${sevenDaysAgoTimestamp}&to=${currentTimestamp}`
        );
        // console.log(response.data)
        
        this.lastWeekChanges = [...response.data.prices]
        // console.log(data)
    }

    
}
</script>