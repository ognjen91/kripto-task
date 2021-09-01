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
