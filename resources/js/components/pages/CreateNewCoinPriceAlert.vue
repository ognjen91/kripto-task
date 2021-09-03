<template>
    <LayoutFloatingWindow
    wrapper-classes="create-coin-price-alert-wrap"
    window-classes="create-coin-price-alert"
    :close-link="closeLink"
    >
    
    <!-- TITLE -->
    <template #title>
            New Price Alert
    </template>

    <!-- CONTENT (IN DEFAULT SLOT OF LAYOUT FLOATING WINDOW) -->

            

            <SelectCoin 
            :initialy-selected="$route.params.id"
            @coinWasSelected="setSelectedCoin"
            >
            <template #title>
                Select Currency
            </template>
            </SelectCoin>

            <div class="target-price-holder flex flex-col lg:flex-row flex-wrap  items-end w-full">
                <!-- PRICE -->
                <div class="flex flex-col notify-value-wrap number-input-wrap">
                    <p class='label'>Notify me when the price reaches</p>
                    <div class="flex  w-full">
                        <input type="number" class='notify-value  text-right' min="0" v-model="targetPrice">
                        <div class="currency f-full flex items-center bg-gray-light font-medium">EUR</div>
                    </div>
                </div>
                <!-- PERCENTAGE RANGE -->
                <div class="flex flex-col  percentage-range-wrap number-input-wrap">
                    <div class="flex  w-full">
                        <input type="number" class='notify-value  text-right' min="0" v-model="percentageRange">
                        <div class="percentage f-full flex items-center bg-gray-light font-medium">%</div>
                    </div>
                </div>
            </div>

            <div class="slider-wrap w-full">
                    <Slider
                    :initialValue="percentageRange" 
                    :min="minPercentageRange" 
                    :max="maxPercentageRange" 
                    append-sign="%" 
                    @valueSelected="setPercentageRangeValue"
                    />
            </div>

            <div class="note-wrap flex flex-col">
                    <p class='label'>Add a Note</p>
                    <textarea class="w-full border" id="" v-model="note"></textarea>
            </div>

            <button class='' @click='submit'>Save alert</button>
    

    </LayoutFloatingWindow>
</template>
<script>
import LayoutFloatingWindow from '@/components/layouts/LayoutFloatingWindow'
import SelectCoin from '@/components/includes/SelectCoin'
import Slider from '@/components/includes/Slider'

export default {
  components: {
    LayoutFloatingWindow,
    SelectCoin,
    Slider
  },


    data(){
        return {
            selectedCoin : null,
            targetPrice : 100,
            percentageRange : 0,
            note : '',
            minPercentageRange : -50,
            maxPercentageRange : 50,
        }
    },

    computed : {
            coins(){
                return this.$store.getters['coins/allCoins']
            },
            closeLink(){
                return this.$router.resolve({name : 'single-currency', params : {id : this.$route.params.id}})
            }
    },

    methods : {
        setSelectedCoin(coin){
            this.selectedCoin = coin
        },
        setPercentageRangeValue(val){
            this.percentageRange = val
        },
        async submit(){
            await this.$store.dispatch('alerts/addNewAlert', {
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
        
         //NUMBERS ONLY!
         targetPrice(newVal, oldVal){
             if (!/^-?[\d.]+(?:e-?\d+)?$/.test(newVal)) this.targetPrice = oldVal //if new value is number, take back the old value!
         },
         percentageRange(newVal, oldVal){
             if (!/^-?[\d.]+(?:e-?\d+)?$/.test(newVal)) this.percentageRange = oldVal //if new value is number, take back the old value!
             if(newVal > this.maxPercentageRange || newVal < this.minPercentageRange) this.percentageRange = oldVal
         },
    },
    
    mounted(){
        
    }
  
}
</script>
<style src="@vueform/slider/themes/default.css"></style>
