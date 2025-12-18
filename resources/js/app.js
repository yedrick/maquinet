import { createApp } from 'vue'
import Landing from './Pages/Landing.vue'
import axios from 'axios'
import '../css/app.css'
import '../css/form-modal.css'
import '../css/thankyou.css'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.withCredentials = true

createApp(Landing).mount('#app')
