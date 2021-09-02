<template>
            <div class="select-wrap w-full relative">

                <!-- SELECTED OPTION -->
                <p><slot name='title'></slot></p>
                <div 
                class="selected option flex justify-between w-full cursor-pointer border" 
                v-if="selectedCoin"
                @click="showDropdown = !showDropdown"
                >
                    <div class="flex items-center">
                        <img :src="selectedCoin.image" alt="" class='mr-2'>
                        <div class="flex flex-col">
                            <p><strong>{{selectedCoin.name}} ({{selectedCoin.symbol}})</strong></p>
                            <p class="price">{{selectedCoin.current_price}} EUR</p>
                        </div>
                    </div>

                    <div class="show-dropdown flex justify-center items-center">
                        <IconChevron :class="{active : showDropdown}" />
                    </div>
                </div>

                <!-- OTHER OPTIONS -->
                <div class="options border w-full absolute bg-white" v-if='showDropdown'>
                    <div 
                    class="option w-full cursor-pointer"
                    v-for="(coin, i) in otherOptions"
                    :key="'coin-option-'+i"
                    @click="select(coin)"
                    >
                        <div class="flex items-center">
                            <img :src="coin.image" alt="" class='mr-2'>
                            <div class="flex flex-col">
                                <p><strong>{{coin.name}} ({{coin.symbol}})</strong></p>
                                <p class="price">{{coin.current_price}} EUR</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</template>
<script>
export default {
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
            this.selectedCoin = this.coins.find(coin => coin.id == this.initialySelected)

            // for dev...
            setTimeout(()=>{
                this.selectedCoin = this.coins[0]
            }, 1000)
        },    
    }
</script>