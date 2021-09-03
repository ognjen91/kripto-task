<template>
    <div class='flex flex-col w-full'>

        <!-- MY WALLET -->
        <div class="my-wallet-wrap w-full">
            <p class="section-title w-full">
                My Btc Wallet 
                <IconEye />
            </p>

            <div class="my-wallet bg-white">
                <p class="text-gray balance-title">Your Balance</p>
                <p class="the-balance font-bold">{{balance}}</p>
                <p class="eur-balance text-gray">≈ {{eurBalance}}</p>

                <div class="buttons flex justify-between">
                    <button class='bg-blue-light text-blue flex'>
                        <IconQr /> 
                        Receive 
                    </button>
                    <button class='border text-blue flex'>
                        <IconPlane /> 
                        Send 
                    </button>
                </div>
            </div>
        </div>

        <!-- MY TRANSACTIONS -->
        <div class="my-transactions-wrap w-full flex flex-col">
            <p class="section-title w-full inline-flex justify-between">
                <span class="">My Transactions</span>
                <span class="text-blue history">View History</span>
            </p>
                <MyTransactions :transactions="transactions" />
        </div>

        
    </div>
</template>
<script>
import MyTransactions from '@/components/includes/MyTransactions'
import IconEye from '@/components/includes/Icons/IconEye'
import IconQr from '@/components/includes/Icons/IconQr'
import IconPlane from '@/components/includes/Icons/IconPlane'
export default {
    components : {
        IconEye,
        IconQr,
        IconPlane,
        MyTransactions
    },

    data(){
        return {
            balance : '0.012921 BTC',
            eurBalance : '200.21 EUR',
            transactions : [
                {
                    day : 15,
                    month : 'Dec',
                    title : 'Received BTC',
                    subtitle : 'from External Wallet',
                    balanceChangeCurrency : '+ 0.2121321421 ETH',
                    balanceChangeEur : '≈ 12.44 EUR',
                },
                {
                    day : 14,
                    month : 'Dec',
                    title : 'Received BTC',
                    subtitle : 'from External Wallet',
                    balanceChangeCurrency : '+ 0.2121321421 ETH',
                    balanceChangeEur : '≈ 12.44 EUR',
                },
                {
                    day : 13,
                    month : 'Dec',
                    title : 'Exchanged BTC',
                    subtitle : 'from External Wallet',
                    balanceChangeCurrency : '- 0.55 BTC',
                    balanceChangeEur : '≈ 12.44 EUR',
                },
                {
                    day : 12,
                    month : 'Dec',
                    title : 'Received BTC',
                    subtitle : 'from External Wallet',
                    balanceChangeCurrency : '+ 0.2121321421 ETH',
                    balanceChangeEur : '≈ 12.44 EUR',
                },
                {
                    day : 11,
                    month : 'Dec',
                    title : 'Received BTC',
                    subtitle : 'from External Wallet',
                    balanceChangeCurrency : '+ 0.2121321421 ETH',
                    balanceChangeEur : '≈ 12.44 EUR',
                },

            ]
        }
    }
}
</script>