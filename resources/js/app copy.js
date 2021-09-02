require('./bootstrap');

import { createApp } from 'vue'
import router from '@/router'
import App from '@/App.vue'

// Reusable components
import IconBase from '@/components/includes/icons/IconBase.vue'

const app = createApp(App)

//Components registration
app.component('icon-base', IconBase)


app.use(router)
app.mount('#app')


// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('28985a5d0af054a90190', {
    cluster: 'eu'
});

var channel = pusher.subscribe('coin-price-changed');
channel.bind('CoinPriceChanged', function(data) {
    alert('Price has changed');
});

Echo.private('coin-price-changed')
.listen('CoinPriceChanged', (e) => {
    alert('Price has changed');
});