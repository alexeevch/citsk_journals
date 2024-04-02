import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/home',
      name: 'home',
      component: HomeView
    },
    {
      path: '/journal',
      name: 'Журнал вторжений',
      component: () => import('../views/JournalView.vue')
    },
    {
      path: '/attackers',
      name: 'Злоумышленники',
      component: () => import('../views/AttackersView.vue')
    },
    {
      path: '/infrastructures',
      name: 'Атакованные ресурсы',
      component: () => import('../views/InfrastructuresView.vue')
    }
  ]
});

export default router;
