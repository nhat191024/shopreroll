import { createApp } from 'vue'
import router from './router/index';
import axios from 'axios'
import VueAxios from 'vue-axios'

import './style.css'
import App from './App.vue'

createApp(App)
.use(router)
.use(VueAxios, axios)
.mount('#app')
