<template>
    <div class="">
        <div class="slider w-full flex relative">
            <div
            v-if="currentValue !== (max + min) / 2" 
            class="tooltip absolute border flex justify-center items-center text-white pb-1" 
            :style="{left : tooltipLeftPosition}"
            :class="{minus : currentValue < (max + min) / 2}"
            >
                {{currentValue}}{{appendSign}}
            </div>

            <div class="slider__range bg-light-gray"
            v-for="(range,i) in totalRanges"
            :key="'range-'+i"
            :style="{width : rangeWidth}"
            :class="{minus : i < (max - min) / 2, plus : i > (max - min) / 2, active : isRangeActive(i)}"
            @click="valueSelected(i)"
            >
            </div>
            <!-- <h1>{{currentValue}}</h1> -->
        </div>
    </div>
</template>
<script>
export default {
    props : {
        initialValue : {
            Type : Number,
            required : false,
            default : 0
        },
        min : {
            Type : Number,
            required : false,
            default : 0
        },
        max : {
            Type : Number,
            required : false,
            default : 100
        },
        appendSign : {
            Type : Number | String,
            required : false,
            default : ""
        }
    },

    data(){
        return {
            currentValue : null
        }
    },

    computed : {
        totalRanges(){
            return this.max + Math.abs(this.min)
        },
        rangeWidth(){
            return (100 / this.totalRanges) + '%'
        },
        tooltipLeftPosition(){
            return 100 - (Math.abs((this.min + this.currentValue) * 100 / (this.max + Math.abs(this.min)))) + '%'
        }
    },

    methods : {
        valueSelected(i){
            let realValue = this.min + i
            this.currentValue = realValue
            this.$emit('valueSelected', realValue)
        },
        isRangeActive(index){
            if(this.min + index >= 0) return this.min + index <= this.currentValue && this.min + index >= 0
            return this.min + index > this.currentValue
        }
    },

    mounted(){
        this.currentValue = this.initialValue
    },

    watch : {
        initialValue(newVal){
            this.currentValue = newVal
        }
    }
}
</script>