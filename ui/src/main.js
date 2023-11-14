import './assets/main.css'

import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import ToastPlugin from 'vue-toast-notification';
import {LoadingPlugin} from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css'
import 'vue-toast-notification/dist/theme-sugar.css';

/**
 * Create application
 */
const app = createApp(App);
app.use(router);
app.use(ToastPlugin);
app.use(LoadingPlugin);
app.mount('#app');
