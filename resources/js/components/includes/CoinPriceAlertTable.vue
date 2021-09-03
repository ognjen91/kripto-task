<template>
    <table class='coin-alerts-index bg-white w-full'>
        <tr class='heading text-gray font-light text-right'>
            <th class='text-left pl-6'>Currency</th>
            <th>Alert Price</th>
            <th>Set On</th>
            <th class='pr-4'>Delete</th>
        </tr>
        <!-- RENDER ROWS DYNAMICALY -->
        <CoinPriceAlertTableRow
        v-for="(coinPriceAlert, i) in usersCoinPriceAlerts"
        :key="'price-alert-'+i"
        :coin-price-alert="coinPriceAlert"
        />

    </table>
</template>
<script>
import CoinPriceAlertTableRow from './CoinPriceAlertTableRow'
export default {
    components : {
        CoinPriceAlertTableRow
    },

    props : {
        usersCoinPriceAlerts : {
            Type : Array,
            required : false,
            default : () => {}
        }
    }
}
</script>