<template>
    <table class='bg-white w-full'>
        <tr>
            <th>Currency</th>
            <th>Alert Price</th>
            <th>Set On</th>
            <th>Delete</th>
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