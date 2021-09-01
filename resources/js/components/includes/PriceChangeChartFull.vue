<template>
        <!-- <h1>{{timeRange}}</h1> -->
        <!-- <h1>{{currentTimestamp}}</h1> -->
        <!-- <h1>{{chartStartTimestamp}}</h1> -->
        <!-- <p>{{chartData}}</p> -->
         <apexchart 
         type="area" 
         height="350" 
         :options="chartOptions" 
         :series="series"
         v-if="this.series[0].data.length"
         ></apexchart>
</template>
<script>
import VueApexCharts from "vue3-apexcharts"
import moment from 'moment'
export default {
    components : {
        apexchart: VueApexCharts,
    },

    props : {
        timeRange : {
            Type : String,
            required : true,
            validator: val => ['1h', '24h', '1w', '1y', 'All'].includes(val)
        },

        coinId : {
            Type : String,
            required : true,
        }
    },

    data(){
        return {
            coinId : null,

            timeRangeData : {
                '1h' : {
                    days : 1,
                    interval : 'minutely',
                    timeFormat : 'H:m',
                    strokeWidth : 2,
                    labelRotate : 0
                }, //seconds in one hour
                '24h' : {
                    days : 1,
                    interval : 'hourly',
                    timeFormat : 'H',
                    strokeWidth : 2,
                    labelRotate : 0
                },
                '1w' : {
                    days : 7,
                    interval : 'daily',
                    timeFormat : 'DD MMM',
                    strokeWidth : 2,
                    labelRotate : -45
                },
                '1y' : {
                    days : 365,
                    interval : 'monthly',
                    timeFormat : 'DD MMM YY',
                    strokeWidth : 1,
                    labelRotate : -45
                },
                'All' : {
                    days : 'max',
                    interval : 'monthly',
                    timeFormat : 'DD MMM YY',
                    strokeWidth : 1,
                    labelRotate : -45
                } 
            },
            currentTimestamp : Math.round(+ (new Date()) / 1000),
            selectedTimeRange : null,
            chartData : {},

            series: [{
                // name: "STOCK ABC",
                // data: [7114.25,7126.6,7116.95,7203.7,7233.75,7451.0,7381.15,7348.95,7347.75,7311.25,7266.4,7253.25,7215.45,7266.35,7315.25,7237.2,7191.4,7238.95,7222.6,7217.9,7359.3,7371.55,7371.15,7469.2,7429.25,7434.65,7451.1,7475.25,7566.25,7556.8,7525.55,7555.45,7560.9,7490.7,7527.6,7551.9,7514.85,7577.95,7592.3,7621.95,7707.95,7859.1,7815.7,7739.0,7778.7,7839.45,7756.45,7669.2,7580.45,7452.85,7617.25,7701.6,7606.8,7620.05,7513.85,7498.45,7575.45,7601.95,7589.1,7525.85,7569.5,7702.5,7812.7,7803.75,7816.3,7851.15,7912.2,7972.8,8145.0,8161.1,8121.05,8071.25,8088.2,8154.45,8148.3,8122.05,8132.65,8074.55,7952.8,7885.55,7733.9,7897.15,7973.15,7888.5,7842.8,7838.4,7909.85,7892.75,7897.75,7820.05,7904.4,7872.2,7847.5,7849.55,7789.6,7736.35,7819.4,7875.35,7871.8,8076.5,8114.8,8193.55,8217.1,8235.05,8215.3,8216.4,8301.55,8235.25,8229.75,8201.95,8164.95,8107.85,8128.0,8122.9,8165.5,8340.7,8423.7,8423.5,8514.3,8481.85,8487.7,8506.9,8626.2]
                data: []
            }],
            chartOptions: {
                chart: {
                    type: 'area',
                    height: 350,
                    zoom: {
                        enabled: false
                    }
                },
                grid: {
                show : false,
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight',
                    width : 2,
                },
                
                // labels: ["02 Jun 2017","05 Jun 2017","06 Jun 2017","07 Jun 2017","08 Jun 2017","09 Jun 2017","12 Jun 2017","13 Jun 2017","14 Jun 2017","15 Jun 2017","16 Jun 2017","19 Jun 2017","20 Jun 2017","21 Jun 2017","22 Jun 2017","23 Jun 2017","27 Jun 2017","28 Jun 2017","29 Jun 2017","30 Jun 2017","03 Jul 2017","04 Jul 2017","05 Jul 2017","06 Jul 2017","07 Jul 2017","10 Jul 2017","11 Jul 2017","12 Jul 2017","13 Jul 2017","14 Jul 2017","17 Jul 2017","18 Jul 2017","19 Jul 2017","20 Jul 2017","21 Jul 2017","24 Jul 2017","25 Jul 2017","26 Jul 2017","27 Jul 2017","28 Jul 2017","31 Jul 2017","01 Aug 2017","02 Aug 2017","03 Aug 2017","04 Aug 2017","07 Aug 2017","08 Aug 2017","09 Aug 2017","10 Aug 2017","11 Aug 2017","14 Aug 2017","16 Aug 2017","17 Aug 2017","18 Aug 2017","21 Aug 2017","22 Aug 2017","23 Aug 2017","24 Aug 2017","28 Aug 2017","29 Aug 2017","30 Aug 2017","31 Aug 2017","01 Sep 2017","04 Sep 2017","05 Sep 2017","06 Sep 2017","07 Sep 2017","08 Sep 2017","11 Sep 2017","12 Sep 2017","13 Sep 2017","14 Sep 2017","15 Sep 2017","18 Sep 2017","19 Sep 2017","20 Sep 2017","21 Sep 2017","22 Sep 2017","25 Sep 2017","26 Sep 2017","27 Sep 2017","28 Sep 2017","29 Sep 2017","03 Oct 2017","04 Oct 2017","05 Oct 2017","06 Oct 2017","09 Oct 2017","10 Oct 2017","11 Oct 2017","12 Oct 2017","13 Oct 2017","16 Oct 2017","17 Oct 2017","18 Oct 2017","19 Oct 2017","23 Oct 2017","24 Oct 2017","25 Oct 2017","26 Oct 2017","27 Oct 2017","30 Oct 2017","31 Oct 2017","01 Nov 2017","02 Nov 2017","03 Nov 2017","06 Nov 2017","07 Nov 2017","08 Nov 2017","09 Nov 2017","10 Nov 2017","13 Nov 2017","14 Nov 2017","15 Nov 2017","16 Nov 2017","17 Nov 2017","20 Nov 2017","21 Nov 2017","22 Nov 2017","23 Nov 2017","24 Nov 2017","27 Nov 2017","28 Nov 2017"],
                labels: [],
                xaxis: {
                type: 'category',
                labels : {
                    rotate: 0,
                }
                },
                yaxis: {
                    show: false
                },
                legend: {
                horizontalAlign: 'left'
                }
            },
        }
    },

    methods : {
        async getChartDataFromApi(){
            this.series[0].data = []
            this.chartOptions.labels = []

            let apiUrl = `https://api.coingecko.com/api/v3/coins/${this.coinId}/market_chart?vs_currency=eur&days=${this.timeRangeData[this.selectedTimeRange].days}&interval=${this.timeRangeData[this.selectedTimeRange].interval}` 
            let chartData = await axios.get(apiUrl);
    
            this.chartData = chartData.data.prices

            // if only last hour is selected, filter data with timestamp from last hour only
            let dataForMapping = this.selectedTimeRange !== '1h'? this.chartData : this.chartData.filter(theData => theData[0] / 1000 >= this.currentTimestamp - 3600)

            this.chartOptions.labels = dataForMapping.map(theData => moment.unix(theData[0] / 1000).format(this.timeRangeData[this.selectedTimeRange].timeFormat))
            this.series[0].data = dataForMapping.map(theData => theData[1])



            this.chartOptions.stroke.width = this.timeRangeData[this.selectedTimeRange].strokeWidth
            this.chartOptions.labels.rotate = this.timeRangeData[this.selectedTimeRange].labelRotate

            console.log(this.chartOptions.labels, this.series[0].data)
            
        }
    },

    watch : {
        timeRange(newVal){
            this.selectedTimeRange = newVal //watch for the prop value and change the param if needed
            this.getChartDataFromApi()
        }
    },

    async mounted(){
        this.coinId = this.$route.params.id
        this.selectedTimeRange = this.timeRange
        await this.getChartDataFromApi()
    }

}
</script>