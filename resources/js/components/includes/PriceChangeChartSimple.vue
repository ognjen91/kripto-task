<template>
        <apexchart 
        v-if="series[0]['data'].length"
        type="line" 
        :options="chartOptions" 
        :series="series"
        >
        </apexchart>
        <!-- height="32px"  -->
</template>
<script>
import VueApexCharts from "vue3-apexcharts"
export default {
  components : {
    apexchart: VueApexCharts,
  },

  props : {
      data : {
          Type: Array,
          required : false,
          default : () => []
      }
  },

  data(){
      return {
        // series represent actual values in the chart
        series: [{
              name: "",
              data: []
          }],


          chartOptions: {
              chart: {
              width: '92px',
              height: '32px',
              toolbar: {
                    show: false,
              },            
              type: 'line',
              zoom: {
                enabled: false
              }
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              curve: 'straight',
              lineCap: 'butt',
              colors: undefined,
              width: 1,
              dashArray: 0,
            },
            grid: {
              show : false,
            },
            xaxis: {
               labels: {
                show: false,
               }
            },
            yaxis: {
               labels: {
                show: false,
               }
            }
          },
      }
  },

    watch : {
        data(newVal){
            let values = newVal.map(theValue => theValue[1])
    
            this.series = [{
                name : "",
                data : newVal.map(theValue => theValue[1])
            }]
        }
    }


}
</script>