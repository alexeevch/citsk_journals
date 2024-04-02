import 'element-plus/dist/index.css';
import 'element-plus/theme-chalk/dark/css-vars.css';
import '@/assets/styles/global.css';

import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { ru } from 'element-plus/es/locale/index';

import ElementPlus from 'element-plus';
import App from './App.vue';
import router from './router';

const app = createApp(App);

app.use(router);
app.use(ElementPlus, { locale: ru });
app.use(createPinia());

app.mount('#app');
