// Styles de base (Tailwind)
import './assets/tailwind.css'

// Vue app
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createPinia } from 'pinia'

// Axios (ta config existante)
import './axios'

// PrimeVue (v4)
import PrimeVue from 'primevue/config'
import Aura from '@primevue/themes/aura'
import 'primeicons/primeicons.css'

// Directives utiles aux PrimeBlocks
import StyleClass from 'primevue/styleclass'   // pour show/hide, menus, etc.
// (optionnel) Effet ripple sur les boutons PrimeVue
// import Ripple from 'primevue/ripple'

// (facultatif) Enregistre quelques composants globaux souvent utilisés par les Blocks
import Button from 'primevue/button'
import Card from 'primevue/card'
// Tu peux en ajouter au besoin : Dialog, InputText, Avatar, Menubar, etc.

const app = createApp(App)

app.use(router)
app.use(createPinia())

app.use(PrimeVue, {
  theme: { preset: Aura },
  // (optionnel) ripple: true,
})

// Directives
app.directive('styleclass', StyleClass)
// app.directive('ripple', Ripple)

// Composants globaux de base
app.component('Button', Button)
app.component('Card', Card)

app.mount('#app')
