<template>
    <LayoutFloatingWindow
    wrapper-classes="coin-price-alert-detail-wrap"
    window-classes="coin-price-alert-detail"
    :close-link="closeLink"
    >
    
    <!-- TITLE -->
    <template #title>
            Price Alert Details
    </template>

     <!-- HEADER PART WITH IMAGE, ALERT PRICE AND CURRENT PRICE, NOTE (HEADER SLOT) -->
     <template #header>
     <div class="w-full flex justify-center header">
        <img :src="coin.image" :alt="'logo'" class=''>
        <div class="flex flex-col price-details">
            <p class="target-price">1 {{coin.symbol}} = {{coinPriceAlert.targetPrice}} EUR</p>
            <p class='current-price text-gray'>Current price: 1 {{coin.symbol}} = {{coin.current_price}} EUR</p>
        </div>
    </div>
    <hr>
    <!-- NOTE -->
    <div class="note-holder flex flex-col">
        <p class='title'><strong>Note</strong></p>
        <p class='inline-block note text-gray' v-html="coinPriceAlert.note || 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Est dolor velit amet justo consequat. Sapien elementum ornare neque, interdum enim posuere dolor.'"></p>
    </div>
    <hr>
     </template>


    <!-- CONTENT (IN DEFAULT SLOT OF LAYOUT FLOATING WINDOW) -->
    <div class="details-holder flex flex-col text-gray">
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
            <router-link 
            tag="button" 
            class='mb-2 close w-full text-center bg-blue text-white'
            :to="{name : 'single-currency', params : {id : $route.params.id}}"
            >
            Close
            </router-link>
            <button @click="deleteAlert">
                Delete Alert
            </button>
    </div>
            
    

    </LayoutFloatingWindow>
</template>
<script>
import IconTimes from '@/components/includes/icons/IconTimes'
import LayoutFloatingWindow from '@/components/layouts/LayoutFloatingWindow'
export default {
    components : {
        LayoutFloatingWindow,
        IconTimes
    },

    computed : {
        coinPriceAlert(){
            return this.$store.getters['coins/getTheAlert'](this.$route.params.id, this.$route.params.alertId)
        },
        coin(){
            return this.$store.getters['coins/getTheCoin'](this.$route.params.id)
        },
        closeLink(){
            return this.$router.resolve({name : 'single-currency', params : {id : this.$route.params.id}})
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