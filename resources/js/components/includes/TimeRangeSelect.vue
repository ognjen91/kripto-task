<template>
    <div class="flex time-range-select">
        <span
        v-for="(option,i) in options"
        :key="'time-range-option-'+i"
        class='option uppercase cursor-pointer bg-blue-light'
        :class="{'active font-bold text-blue' : selected == option, 'text-gray' : selected !== option}"
        @click='select(option)'
        >
        {{option}}
        </span>
    </div>
</template>
<script>
export default {
    data(){
        return {
            selected : '24h',
            options : ['1h', '24h', '1w', '1y', 'All']
        }
    },

    methods : {
        select(option){
            if(option == this.selected) return
            this.selected = option
            this.$emit('timeRangeSelected', option)
        }
    }
}
</script>