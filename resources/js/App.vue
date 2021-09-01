<template>
    <div>
        <Header />
            <main class='flex justify-center'>
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
    }
}
</script>