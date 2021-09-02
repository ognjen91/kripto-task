<template>
    <div>
        <Header />
            <main class='container'>
                <router-view></router-view>
            </main>
        <Footer />
    </div>
</template>

<script>
import Header from '@/components/includes/Header'
import Footer from '@/components/includes/Footer'
export default {
    components : {
        Header,
        Footer
    },

    data(){
        return {
            perPage : 20
        }
    },

    async created(){
        this.$store.dispatch('coins/setCoinsData', {perPage : this.perPage})
    }
}
</script>