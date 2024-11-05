import { createRouter, createWebHistory } from 'vue-router';
import JournalSection from '@/components/sections/JournalSection.vue';
import HomeSection from '@/components/sections/HomeSection.vue';

export const routes = [
  {
    path: '/',
    name: 'home',
    props: {
      label: 'Главная',
      icon: '@/assets/icons/homepage.svg'
    },
    component: HomeSection
  },
  {
    path: '/journal',
    name: 'journal',
    props: {
      label: 'Журнал вторжений',
      icon: '@/assets/icons/journal.svg'
    },
    component: JournalSection
  }];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: routes
});

export default router;
