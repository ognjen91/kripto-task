<template>
    <div>
        <Header />
            <router-view></router-view>
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
    }
}
</script>