<template>
    <div class="numbers-under-chart flex justify-between">
        <div 
        class="numer flex flex-col"
        v-for="(data,i) in numericData"
        :key="'numeric-data-'+i"
        >
            <p class="label text-gray">{{data.label}}</p>
            <p class="value">{{data.value}}</p>
        </div>
    </div>
</template>
<script>
export default {
    props : {
        totalMarketCap : {
            Type : Number,
            required : true,
        },
        volumeTwentyFour : {
            Type : Number | String,
            required : true,
            default : "?",
        },
        circulantSuply : {
            Type : Number | String,
            required : true,
            default : '18.2M BTC'
        },
        kriptomatPopularity : {
            Type : Number | String,
            required : true,
            default : '18.2M BTC'
        },
    },

    computed: {
        formatedMarketCap(){
            return Math.floor(+this.totalMarketCap/1000000000)
        },
        numericData(){
            return [
                {
                    label : 'Total Market cap',
                    value : this.formatedMarketCap + 'B'
                },
                {
                    label : 'Volume (24 hours)',
                    value : this.volumeTwentyFour
                },
                {
                    label : 'Circulating supply',
                    value : this.circulantSuply
                },
                {
                    label : 'Popularity on Kriptomat',
                    value : this.kriptomatPopularity
                }
            ]
        }
    }
}
</script>