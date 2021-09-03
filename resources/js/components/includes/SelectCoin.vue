<template>
            <div class="select-wrap w-full relative">

                <p class='label'><slot name='title'></slot></p>

            
                <!-- SELECTED OPTION -->
                <div 
                class="selected option flex justify-between w-full cursor-pointer border relative" 
                v-if="selectedCoin"
                @click="showDropdown = !showDropdown"
                >
                    <!-- OPTION CONTENT -->
                    <div class="flex items-center option-content">
                        <img :src="selectedCoin.image" alt="" class='mr-2'>
                        <div class="flex flex-col">
                            <p class='option-name'><strong>{{selectedCoin.name}} <span class="uppercase">({{selectedCoin.symbol}})</span></strong></p>
                            <p class="price text-gray">{{selectedCoin.current_price}} EUR</p>
                        </div>
                    </div>
                    <!-- DROPDOWN THAT ROTATES -->
                    <div class="show-dropdown flex justify-center items-center bg-gray">
                        <IconChevron :class="{active : showDropdown}" />
                    </div>
                </div>

                <!-- OTHER OPTIONS -->
                <div class="options border w-full absolute bg-white" v-if='showDropdown'>
                    <!-- STRUCTURE IS THE SAME AS FOR SELECTED OPTION -->
                        <div 
                        class="option w-full cursor-pointer"
                        v-for="(coin, i) in otherOptions"
                        :key="'coin-option-'+i"
                        @click="select(coin)"
                        >
                        <div class="flex items-center option-content">
                            <div class="flex items-center">
                                <img :src="coin.image" alt="" class='mr-2'>
                                <div class="flex flex-col">
                                    <p class='option-name'><strong>{{coin.name}} <span class="uppercase">({{coin.symbol}})</span></strong></p>
                                    <p class="price text-gray">{{coin.current_price}} EUR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</template>
<script>

import IconChevron from '@/components/includes/icons/IconChevron'
export default {
        components: {
            IconChevron
        },

        props : {
            initialySelected : {
                Type : String,
                required : true
            }
        },

        data(){
            return {
                selectedCoin : null,
                showDropdown : false
            }
        },
        
        computed : {
            coins(){
                return this.$store.getters['coins/allCoins']
            },
            otherOptions(){
                return this.coins.filter(coin => coin.id !== this.selectedCoin.id)
            }        
        },

        methods : {
            select(coin){
                this.selectedCoin = coin
                this.showDropdown = false
                this.$emit('coinWasSelected', coin)
            }
        },

        mounted(){
            setTimeout(()=>{
                 let selectedCoin = this.$store.getters['coins/getTheCoin'](this.initialySelected)
                 this.select(selectedCoin)
            }, 200)

        },    

        
    }
</script>