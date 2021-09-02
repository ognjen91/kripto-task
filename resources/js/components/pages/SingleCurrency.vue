<template>
    <div class="row"  v-if="coin">

        <!-- BASIC DATA... NAME -->
        <div class="col-12 flex justify-start items-center mb-3">
            <img :src="coin.image.small" :alt="'logo of ' + coin.name">
            <h1 class="mx-2">{{coin.name}}</h1>
            <span class="uppercase">{{coin.symbol}}</span>
        </div>
        <div class="col-12 mb-3">
            <h2><strong>Overview</strong></h2>
        </div>

    </div>

    <!-- NUMERIC DATA WITH CHART-->
    <div class="row flex flex-wrap bg-white" v-if="coin">
    <!-- 1) BASIC NUMERIC DATA -->
        <div class="w-1/6 flex flex-col">
            <p>{{coin.name}} Price</p>
            <h3>{{coin.market_data.current_price.eur}} EUR</h3>
        </div>
        <div class="w-1/6 flex flex-col pl-4">
            <p>Last 24h</p>
            <p>{{formatedPriceChange}}</p>
        </div>

        <!-- 2) TIME RANGE SELECTION -->
        <div class="w-2/3 flex justify-end">
            <TimeRangeSelect
            @timeRangeSelected='setTimeRange'
             />
        </div>

        <!-- 3) PRICE CHART FOR THE SEECTED RANGE -->
        <div class="w-full pt-5">
            <PriceChangeChartFull :time-range="selectedTimeRange" />
        </div>
    </div>


    <div class="row flex flex-wrap pt-5">
        <div class="col-12 w-full">
            <h2 class='w-full inline-flex justify-between'>Price Alerts <span @click="showCreateNewCoinPriceAlertWindow = true">New Price Alert</span></h2>

            <CoinPriceAlertTable :users-coin-price-alerts="usersCoinPriceAlerts" />
        </div>
    </div>

    <CreateNewCoinPriceAlert 
    :show="showCreateNewCoinPriceAlertWindow" 
    :initialy-selected="$route.params.id"
    />


</template>
<script>
import TimeRangeSelect from '@/components/includes/TimeRangeSelect'
import PriceChangeChartFull from '@/components/includes/PriceChangeChartFull'
import CoinPriceAlertTable from '@/components/includes/CoinPriceAlertTable'
import CreateNewCoinPriceAlert from '@/components/includes/CreateNewCoinPriceAlert'
export default {
    components : {
        TimeRangeSelect,
        PriceChangeChartFull,
        CoinPriceAlertTable,
        CreateNewCoinPriceAlert
    },

    data(){
        return {
            coin : null,
            chartData : {},
            selectedTimeRange : '24h',
            usersCoinPriceAlerts : [],
            showCreateNewCoinPriceAlertWindow : true
        }
    },

    computed : {
        formatedPriceChange(){
            // return this.coin.price_change_percentage_24h
            let plusMinus = this.coin.market_data.price_change_percentage_24h > 0? '+' : '-'
            return `${plusMinus} ${this.coin.market_data.price_change_24h} EUR (${plusMinus} ${this.coin.market_data.price_change_percentage_24h}%)`
        },
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
        // const data = basicData.data;
        this.coin = basicData.data
        // console.log(data)

        // GET COIN PRICE ALERTS FOR THE USER
        axios.get(`/api/user/alerts/${coinId}`)
        // axios.get(`/api/user`)
        .then(({data}) => {
            // handle success
            this.usersCoinPriceAlerts = [...data.coinPriceAlerts]
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });

    }
}
</script>