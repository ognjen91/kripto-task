<template>
        <tr v-if='coin' class='alert-row text-right'>
            <td class='text-left'>
                <div class="h-full flex items-center">
                <router-link
                class='h-full flex items-center' 
                :to="{name : 'alert-details', params : {id:$route.params.id, alertId : coinPriceAlert.id}}">
                <img :src="coin.image" alt="" class='mr-2'> {{coin.name}} <span class='uppercase ml-2'>{{coin.symbol}}</span>
                </router-link>
                </div>
            </td>
            <td>1 <span class="uppercase">{{coin.symbol}}</span> > {{coinPriceAlert.targetPrice}} EUR</td>
            <td>{{coinPriceAlert.createdAt}}</td>
            <td>
                <div @click="deleteAlert" class='cursor-pointer flex justify-end'>
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

    computed : {
        coin(){
            return this.$store.getters['coins/getTheCoin'](this.coinPriceAlert.coinId)
        }
    },

    methods : {
        deleteAlert(){
            if(!confirm("Are you sure that you want to delete this alert?")) return;
            this.$store.dispatch('alerts/deleteAlert', {
                id : this.coinPriceAlert.id,
                coinId : this.coinPriceAlert.coinId
            })
        }
    }
}
</script>