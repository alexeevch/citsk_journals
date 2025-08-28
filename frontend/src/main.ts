import { createApp } from 'vue';
import { createPinia } from 'pinia';

import App from '@/App.vue';
import router from '@/router/router.ts';
import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';

import 'primeicons/primeicons.css';
import '@/assets/style/global.css';

const app = createApp(App);

app.use(createPinia());
app.use(router);
app.use(PrimeVue, {
  theme: {
    preset: Aura,
    options: {
      prefix: 'p',
      darkModeSelector: false,
      cssLayer: false,
    },
  },
});

app.mount('#app');
