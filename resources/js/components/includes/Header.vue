<template>
    <header class='flex'>
        <router-link :to="{name : 'home'}" class='logo' tag='div'><IconLogo /></router-link>
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