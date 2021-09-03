<template>
    <tr class='text-right'>
        <td class='text-left logo-and-name flex items-center h-full'>
            <!-- STAR, FULL IF COIN HAS ALERTS -->
            <IconStarFull v-if="hasAlerts" />
            <IconStarEmpty v-else />
            <!-- IMAGE -->
            <img :src="coin.image" :alt="'logo of ' + coin.name" class="w-full">

            <router-link :to="{name : 'single-currency', params : {id : coin.id}}" class='text-medium'>
                {{coin.name}} 
            </router-link>
            <span class="uppercase ml-2 text-gray">{{coin.symbol}}</span>
        </td>
        <td>{{coin.current_price}}</td>
        <td :class="{'text-green' : coin.price_change_percentage_24h>0, 'text-red' : coin.price_change_percentage_24h < 0}">{{coin.price_change_percentage_24h}} %</td>
        <td>{{coin.market_cap}}</td>
        <td>/</td>
        <!-- <td class='seven-days-chart'><PriceChangeChartSimple :data="lastWeekChanges" /></td> -->
    </tr>
</template>
<script>
import PriceChangeChartSimple from '@/components/includes/PriceChangeChartSimple'
import IconStarFull from '@/components/includes/icons/IconStarFull'
import IconStarEmpty from '@/components/includes/icons/IconStarEmpty'
export default {
    components : {
        PriceChangeChartSimple,
        IconStarFull,
        IconStarEmpty,
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

    computed : {
          hasAlerts(){
              let idsOfCoinsWithAlerts = this.$store.getters['alerts/idsOfCoinsWithAlerts']
              return idsOfCoinsWithAlerts.includes(this.coin.id)
          }
    },

    async mounted(){
        let currentTimestamp = Math.round(+ (new Date()) / 1000)
        let sevenDaysAgoTimestamp = currentTimestamp - 7 * 24 * 3600

        const response = await axios.get(
            `https://api.coingecko.com/api/v3/coins/${this.coin.id}/market_chart/range?vs_currency=eur&from=${sevenDaysAgoTimestamp}&to=${currentTimestamp}`
        );
        
        this.lastWeekChanges = [...response.data.prices]
    }

    
}
</script>