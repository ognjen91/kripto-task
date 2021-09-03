<template>
        <div class="full-size-dark-wrap coin-price-alert-detail-wrap fixed flex justify-center items-center" v-if="coin && coinPriceAlert">

            <div class="coin-price-alert-detail floating-window  bg-white flex flex-col relative">
                <div class="w-full">
                    <p class='w-full text-center'>Price alert details</p>
                     <router-link :to="{name : 'single-currency', params : {id : $route.params.id}}" class='absolute top-0 right-3'>
                        <IconTimes />
                     </router-link>
                </div>
                <!-- {{coin.name}} -->
                <div class="w-full flex justify-center header mb-5">
                    <img :src="coin.image" :alt="'logo'" class='mr-2'>
                    <div class="flex flex-col price-details">
                        <p class="h1">1 {{coin.symbol}} = {{coinPriceAlert.targetPrice}} EUR</p>
                        <p>Current price: 1 {{coin.symbol}} = {{coin.current_price}} EUR</p>
                    </div>
                </div>

                <div class="note-holder border flex flex-col px-3">
                    <p><strong>Note</strong></p>
                    <p v-html="coinPriceAlert.note || 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Est dolor velit amet justo consequat. Sapien elementum ornare neque, interdum enim posuere dolor.'"></p>
                </div>

                <div class="details-holder flex flex-col">
                    <div class="detail flex justify-between">
                        <p>Set Date</p>
                        <p>{{coinPriceAlert.createdAt}}</p>
                    </div>
                    <div class="detail flex justify-between">
                        <p>Price on set date</p>
                        <p>1 {{coin.symbol}} = {{coinPriceAlert.priceOnSetDate}} EUR</p>
                    </div>
                </div>

                <div class="buttons-holder flex flex-col">
                     <router-link tag="button" :to="{name : 'single-currency', params : {id : $route.params.id}}" class='mb-2 close w-full text-center'>
                        Close
                     </router-link>
                     <button @click="deleteAlert">
                         Delete Alert
                     </button>
                </div>

            </div>
        </div>
</template>
<script>
import IconTimes from '@/components/includes/icons/IconTimes'
export default {
    components : {
        IconTimes
    },

    computed : {
        coinPriceAlert(){
            return this.$store.getters['coins/getTheAlert'](this.$route.params.id, this.$route.params.alertId)
        },
        coin(){
            return this.$store.getters['coins/getTheCoin'](this.$route.params.id)
        }
    },

    methods : {
            async deleteAlert(){
            if(!confirm("Are you sure that you want to delete this alert?")) return;
                 await this.$store.dispatch('coins/deleteAlert', {
                 id : this.coinPriceAlert.id,
                 coinId : this.$route.params.id
            })

            this.$router.push({name : 'single-currency', params : {id : this.$route.params.id}})
        }
    },

}
</script>