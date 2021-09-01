<template>
    <div class="flex">
        <span
        v-for="(option,i) in options"
        :key="'time-range-option-'+i"
        class='mr-2 uppercase cursor-pointer'
        :class="{'active font-bold' : selected == option}"
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