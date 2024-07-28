import { createRouter, createWebHistory } from 'vue-router';
const routes = [];

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title || 'Shop reroll';
    next();
  });

export default router;