import { createRouter, createWebHistory } from 'vue-router';
import client from '@/router/client';
const routes = [...client];

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title || 'Shop reroll';
    next();
  });

export default router;