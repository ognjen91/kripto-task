<template>
    <LayoutFloatingWindow
    wrapper-classes="alert-window-wrap"
    window-classes="alert-window"
    :close-link="closeLink"
    v-if='coin'
    :emit-close-event-on-close-icon-click="true"
    @close="emitClose"
    >
    
    <!-- TITLE -->
    <template #header>
        <div class="header w-full flex flex-col items-center justify-center">
            <IconBell />
            <p class="mb-0 text-blue">Price Alert</p>
        </div>
    </template>

    <div class="content flex flex-col">
        <!-- NOTIF TEXT -->
        <p class="notif-text text-center">
            {{coin.name}} just shot past <br> {{currentPrice}} EUR
        </p>

        <!-- NOTIFICATION DATA -->
        <div class="coin-data flex">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Ethereum-icon-purple.svg/1200px-Ethereum-icon-purple.svg.png" alt="">
            <div class="flex flex-col w-auto data-holder">
                <div class="name-and-price flex justify-between w-auto">
                    <p class="name">{{coin.name}}</p>
                    <p class="price">= {{alert.currentPrice}} EUR</p>
                </div>
                <div class="symbol-and-date flex justify-between w-auto">
                    <p class="symbol text-gray uppercase">{{coin.symbol}}</p>
                    <p class="date text-gray">{{ alert.date }} at {{alert.time}}</p>
                </div>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="buttons w-full flex justify-between">
            <button class='bg-blue-light text-blue' @click="emitClose">Dissmis</button>
            <button class='bg-blue text-white'>Buy &amp; Sell</button>
        </div>

        <!-- EDIT BUTTON -->
        <div class="edit"><a href="#" class='text-gray flex w-full justify-center'><IconEdit/> Update Alert</a></div>
    </div>


    </LayoutFloatingWindow>
</template>
<script>
import LayoutFloatingWindow from '@/components/layouts/LayoutFloatingWindow'
import IconBell from '@/components/includes/icons/IconBell'
import IconEdit from '@/components/includes/icons/IconEdit'
import moment from 'moment';
export default {
  components: {
    LayoutFloatingWindow,
    IconBell,
    IconEdit
  },

    props : {
        alert : {
            Type : Object,
            required: true
        },
        alertKey : {
            Type : Number,
            required : true
        }
    },


    computed : {
        closeLink(){
             return this.$router.currentRoute
        },
        coin(){
            return this.$store.getters['coins/getTheCoin'](this.alert.coinId)
        },
    },

    methods : {
        emitClose(){
            this.$emit('close', this.alertKey)
        }
    }
}
</script>