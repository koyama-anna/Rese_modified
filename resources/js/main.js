import { createApp } from 'vue'
import App from './App.vue'
import router from './router.js'
import axios from 'axios';

const token = localStorage.getItem('token');
axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
createApp(App).use(router).mount('#app')
