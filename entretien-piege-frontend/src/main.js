import './assets/tailwind.css'
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createPinia } from 'pinia'
import './axios' // Importer la configuration d'Axios
import PrimeVue from 'primevue/config'
import Aura from '@primevue/themes/aura'       // thème moderne
import 'primeicons/primeicons.css'

const app = createApp(App)
app.use(router)
app.use(createPinia())
app.use(PrimeVue, { theme: { preset: Aura } }) 
app.mount('#app')

