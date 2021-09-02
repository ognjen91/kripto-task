<template>
    <div class="full-size-dark-wrap create-coin-price-alert-wrap fixed flex justify-center items-center">
    <!-- <div class="full-size-dark-wrap create-coin-price-alert-wrap fixed flex justify-center items-center" v-if='selectedCoin'> -->
        <div class="create-coin-price-alert floating-window bg-white flex flex-col">
            <div class="w-full">
                <p class='w-full text-center'>New Price Alert</p>
                    <router-link :to="{name : 'single-currency', params : {id : $route.params.id}}" class='absolute top-0 right-3'>
                    <IconTimes />
                    </router-link>
            </div>

            <SelectCoin 
            class='mb-3'
            :initialy-selected="$route.params.id"
            @coinWasSelected="setSelectedCoin"
            >
            <template #title>
                Select Currency
            </template>
            </SelectCoin>

            <div class="flex flex-col lg:flex-row flex-wrap  items-end w-full">
                <!-- PRICE -->
                <div class="flex flex-col notify-value-wrap number-input-wrap">
                    <p>Notify me when the price reaches</p>
                    <div class="flex  w-full">
                        <input type="number" class='notify-value' min="0" v-model="targetPrice">
                        <div class="currency f-full flex items-center bg-gray">EUR</div>
                    </div>
                </div>
                <!-- PERCENTAGE RANGE -->
                <div class="flex flex-col  percentage-range-wrap number-input-wrap">
                    <div class="flex  w-full">
                        <input type="number" class='notify-value' min="0" v-model="percentageRange">
                        <div class="percentage f-full flex items-center bg-gray">%</div>
                    </div>
                </div>
            </div>

            <div class="slider-wrap w-full pt-5">
                    <Slider
                    :initialValue="percentageRange" 
                    :min="-50" 
                    :max="50" 
                    append-sign="%" 
                    @valueSelected="setPercentageRangeValue"
                    />
            </div>

            <div class="note-wrap flex flex-col">
                    <p>Note</p>
                    <textarea class="w-full" id="" v-model="note"></textarea>
            </div>

            <button class='mt-3' @click='submit'>Save alert</button>
        </div>
    </div>
</template>
<script>
import IconChevron from '@/components/includes/icons/IconChevron'
import SelectCoin from '@/components/includes/SelectCoin'
import Slider from '@/components/includes/Slider'

export default {
  components: {
    IconChevron,
    SelectCoin,
    Slider
  },


    data(){
        return {
            selectedCoin : null,
            targetPrice : 100,
            percentageRange : 0,
            note : ''
        }
    },

    computed : {
            coins(){
                return this.$store.getters['coins/allCoins']
            },
    },

    methods : {
        setSelectedCoin(coin){
            this.selectedCoin = coin
        },
        setPercentageRangeValue(val){
            this.percentageRange = val
        },
        async submit(){
            await this.$store.dispatch('coins/addNewAlert', {
                coinId : this.selectedCoin.id,
                priceOnSetDate : this.selectedCoin.current_price,
                targetPrice : this.targetPrice,
                percentageRange : this.percentageRange,
                note : this.note
            })

            this.$router.push({name : 'single-currency', params : {id : this.$route.params.id}})
        }
    },

    watch : {
        selectedCoin: {
        handler(val, oldVal){
            this.targetPrice = val.current_price + 10
        },
        deep: true
         },

         targetPrice(newVal, oldVal){
             if (!/^-?[\d.]+(?:e-?\d+)?$/.test(newVal)) this.targetPrice = oldVal //if new value is number, take back the old value!
         }
    },
    
    mounted(){
        // this.selectedCoin = this.$store.getters['coins/getTheCoin'](this.$route.params.id)
    }
  
}
</script>
<style src="@vueform/slider/themes/default.css"></style>
