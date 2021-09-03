<template>
    <div class="single flex justify-between"  v-if="coin">
    <!-- <div class="row flex" >
        
    </div> -->

    <!-- NUMERIC DATA WITH CHART-->
    <div class="numeric-and-alerts flex flex-col relative">
        <!-- BASIC DATA... NAME, LOGO, STAR -->
        <div class="header col-12 flex justify-start items-center mb-3">
            <img :src="coin.image.small" :alt="'logo of ' + coin.name">
            <h1 class="mx-2 mb-0">{{coin.name}} <span class="uppercase text-gray">{{coin.symbol}}</span></h1>
            
            <!-- STAR, FULL IF COIN HAS ALERTS -->
            <IconStarFull v-if="hasAlerts" />
            <IconStarEmpty v-else />
        </div>

        <div class="col-12 mb-3">
            <h2 class='section-title'><strong>Overview</strong></h2>
        </div>
        <div class="numeric row flex flex-wrap bg-white relative" v-if="coin">

              <!-- 1) BASIC NUMERIC DATA -->
                <div class="basic w-full flex">
                    <!-- NAME AND PRICE -->
                    <div class="name-price flex flex-col">
                        <p class='basic-label font-gray'>{{coin.name}} Price</p>
                        <h3 class='font-bold'>{{coin.market_data.current_price.eur}} EUR</h3>
                    </div>
                    <!-- LAST 24H -->
                    <div class="last-24 flex flex-col pl-4">
                        <p class='basic-label font-gray'>Last 24h</p>
                        <p class='change' :class="{'text-green' : coin.market_data.price_change_percentage_24h > 0, 'text-red' : coin.market_data.price_change_percentage_24h < 0}">
                        {{formatedPriceChange}}
                        <span class="perc-change" :class="{'plus' : coin.market_data.price_change_percentage_24h > 0, 'minus' : coin.market_data.price_change_percentage_24h < 0}">{{formatedPercentageChange}}</span>
                        </p>
                    </div>
                </div>

                <!-- 2) TIME RANGE SELECTION -->
                <div class="time-range-wrap absolute flex justify-end">
                    <TimeRangeSelect
                    @timeRangeSelected='setTimeRange'
                    />
                </div>

                <div class="w-full">
                <!-- 3) PRICE CHART FOR THE SEECTED RANGE -->
                    <PriceChangeChartFull :time-range="selectedTimeRange" />
                </div>

                <!-- 4) NUMBERS UNDER CHART -->
                <div class="w-full">
                    <NumbersUnderChart
                    :total-market-cap="18999999999"
                    :volume-twenty-four="'?'"
                    />
                </div>

            </div>


            <div class="row flex flex-wrap pt-5 alerts">
                <div class="col-12 w-full">
                    
                    <h2 class='section-title flex w-full inline-flex justify-between'>
                        Price Alerts 
                        <router-link 
                        :to="{name : 'alert-create', params : {id : $route.params.id}}"
                        class='text-blue new-alert-link'
                        >
                        + New Price Alert
                        </router-link>
                    </h2>

                    <CoinPriceAlertTable :users-coin-price-alerts="usersCoinPriceAlerts" />
                </div>
            </div>
    </div>

    <div class="single-aside">
        <SingleAside/>
    </div>


    <!-- ROUTER VIEW FOR DETAILS & CREATE -->
    <router-view></router-view>

    </div>
</template>
<script>
import TimeRangeSelect from '@/components/includes/TimeRangeSelect'
import NumbersUnderChart from '@/components/includes/NumbersUnderChart'
import PriceChangeChartFull from '@/components/includes/PriceChangeChartFull'
import CoinPriceAlertTable from '@/components/includes/CoinPriceAlertTable'
import SingleAside from '@/components/includes/SingleAside'
import IconStarFull from '@/components/includes/icons/IconStarFull'
import IconStarEmpty from '@/components/includes/icons/IconStarEmpty'

export default {
    components : {
        TimeRangeSelect,
        PriceChangeChartFull,
        NumbersUnderChart,
        CoinPriceAlertTable,
        SingleAside,
        IconStarFull,
        IconStarEmpty
    },

    data(){
        return {
            coin : null,
            chartData : {},
            selectedTimeRange : '24h',
            // usersCoinPriceAlerts : [],
            showCreateNewCoinPriceAlertWindow : false
        }
    },

    computed : {
        formatedPriceChange(){
            // return this.coin.price_change_percentage_24h
            let plusMinus = this.coin.market_data.price_change_percentage_24h > 0? '+' : '-'
            return `${plusMinus} ${this.coin.market_data.price_change_24h} EUR`
        },
        formatedPercentageChange(){
            let plusMinus = this.coin.market_data.price_change_percentage_24h > 0? '+' : '-'
            return `${plusMinus} ${this.coin.market_data.price_change_percentage_24h}%`
        },

        usersCoinPriceAlerts(){
            return this.$store.getters['coins/alertsForCoinWithId'](this.$route.params.id)
        },
        hasAlerts(){
            let idsOfCoinsWithAlerts = this.$store.getters['coins/idsOfCoinsWithAlerts']
            return idsOfCoinsWithAlerts.includes(this.$route.params.id)
        }
    },


    methods : {
        setTimeRange(option){
            this.selectedTimeRange = option
        }
    },

    async mounted(){


        let coinId = this.$route.params.id

        const basicData = await axios.get(
            `https://api.coingecko.com/api/v3/coins/${coinId}`
        );
        this.coin = basicData.data


    }
}
</script>