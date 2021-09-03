<template>
    <div class="my-transactions bg-white flex flex-col">
        <div 
        class="transaction flex"
        v-for="(transaction,i) in transactions"
        :key="'transaction-'+i"
        >
            <div class="w-2/12 flex flex-col">
                <p class="day">{{transaction.day}}</p>
                <p class="month">{{transaction.month}}</p>
            </div>
            <div class="w-5/12 flex flex-col">
                <p class="title">{{transaction.title}}</p>
                <p class="subtitle text-gray">{{transaction.subtitle}}</p>
            </div>
            <div class="w-5/12 flex flex-col">
                <p class="balance text-right">{{transaction.balanceChangeCurrency}}</p>
                <p class="balance-eur text-gray text-right">{{transaction.balanceChangeEur}}</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props : {
        transactions : {
            Type : Array,
            required : true
        }
    }
}
</script>