<template>
    <header class='flex justify-start items-center bg-white'>
        <router-link :to="{name : 'home'}" class='logo mr-1' tag='div'><IconLogo /></router-link>
        <router-link :to="{name : 'single-currency', params : {slug : 'btc'}}">Single</router-link>
    </header>
</template>

<script>
import IconLogo from '@/components/includes/icons/IconLogo'
export default {
    components : {
        IconLogo
    }
}
</script>