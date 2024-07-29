import { createApp } from 'vue'
import router from './router/index';
import axios from 'axios'
import PrimeVue from "primevue/config";
import pre from '../presets/aura'

import './style.css'
import 'primeicons/primeicons.css'
import App from './App.vue'

createApp(App)
    .use(PrimeVue, {
        unstyled: true,
        pt: pre,
    })
    .use(router)
    .mount('#app');
