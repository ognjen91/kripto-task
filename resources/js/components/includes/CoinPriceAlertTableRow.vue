<template>
        <tr>
            <td><router-link :to="{name : 'alert-details', params : {id:$route.params.id, alertId : coinPriceAlert.id}}">{{coinPriceAlert.coinId}}</router-link></td>
            <td>1 {{coinPriceAlert.coinId}} > {{coinPriceAlert.targetPrice}}</td>
            <td>{{coinPriceAlert.createdAt}}</td>
            <td>
                <div @click="deleteAlert" class='cursor-pointer'>
                 <IconTrash width='70px' height='70px' />
                </div>
            </td>
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
    },

    methods : {
        deleteAlert(){
            if(!confirm("Are you sure that you want to delete this alert?")) return;
            this.$store.dispatch('coins/deleteAlert', {
                id : this.coinPriceAlert.id,
                coinId : this.coinPriceAlert.coinId
            })
        }
    }
}
</script>