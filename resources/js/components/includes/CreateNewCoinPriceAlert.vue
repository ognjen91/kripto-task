<template>
    <div class="full-size-dark-wrap create-coin-price-alert-wrap fixed flex justify-center items-center" v-if="show">
        <div class="create-coin-price-alert bg-white flex flex-col">
            <SelectCoin 
            class='mb-3'
            :initialy-selected="initialySelected"
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
                        <input type="number" class='notify-value' min="0" v-model="notifyValue">
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

  props : {
      show : {
          Type : Boolean,
          required : true
      },
      initialySelected : {
          Type : String,
          required : true
      }
  },

    data(){
        return {
            selectedCoin : null,
            notifyValue : 100,
            percentageRange : 0
        }
    },

    methods : {
        setSelectedCoin(coin){
            this.selectedCoin = coin
        },
        setPercentageRangeValue(val){
            this.percentageRange = val
        }
    },

    watch : {
        show(newVal){
            this.selectedCoin = this.coins.find(coin => coin.id == this.initialySelected)
        },
        selectedCoin: {
        handler(val, oldVal){
            this.notifyValue = val.current_price + 10
        },
        deep: true
         },

         notifyValue(newVal, oldVal){
             if (!/^-?[\d.]+(?:e-?\d+)?$/.test(newVal)) this.notifyValue = oldVal //if new value is number, take back the old value!
         }
}
  
}
</script>
<style src="@vueform/slider/themes/default.css"></style>
