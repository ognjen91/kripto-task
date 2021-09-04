<template>
    <header class='flex justify-between items-center bg-white'>
        <router-link :to="{name : 'home'}" class='logo mr-1' tag='div'><IconLogo /></router-link>

        <div class='links text-blue' v-if="!userIsLogged">
            <a href="/login" class='mr-2'>Login</a>
            <a href="/register">Register</a>
        </div>
    </header>
</template>

<script>
import IconLogo from '@/components/includes/icons/IconLogo'
export default {
    components : {
        IconLogo
    },
    computed : {
        userIsLogged(){
            return this.$store.getters['auth/userIsLogged']
        }
    }
}
</script>