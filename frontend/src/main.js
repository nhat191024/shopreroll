import { createApp } from 'vue'
import { VueRecaptchaPlugin, useRecaptchaProvider } from 'vue-recaptcha'
import { createHead } from '@unhead/vue'
import router from './router/index';
import axios from 'axios'
import PrimeVue from "primevue/config";
import ToastService from 'primevue/toastservice';
import pre from '../presets/aura'
import './style.css'
import 'primeicons/primeicons.css'

import App from './App.vue'

const head = createHead()

createApp(App)
    .use(head)
    .use(ToastService)
    .use(PrimeVue, {
        unstyled: true,
        pt: pre,
    })
    .use(VueRecaptchaPlugin, {
        v2SiteKey: import.meta.env.VITE_RECAPTCHA_V2_SITE,
        v3SiteKey: import.meta.env.VITE_RECAPTCHA_V3_SITE,
    })
    .use(router)
    .mount('#app');
