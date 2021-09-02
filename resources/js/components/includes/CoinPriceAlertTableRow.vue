<template>
        <tr>
            <td>{{coinPriceAlert.coinId}}</td>
            <td>1 {{coinPriceAlert.coinId}} > {{coinPriceAlert.price}}</td>
            <td>{{coinPriceAlert.createdAt}}</td>
            <td><IconTrash width='70px' height='70px' /></td>
        </tr>
</template>
<script>
import IconTrash from '@/components/includes/icons/IconTrash'
export default {
    components : {
        IconTrash
    },

    props : {
        coinPriceAlert : {
            Type : Object,
            required : true
        }
    }
}
</script>