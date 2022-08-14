import { createRouter, createWebHistory } from 'vue-router'
import store from '../store';
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/auth',
      name: 'auth',

      component: () => import('../components/AuthLayout.vue'),
      meta: {isGuest: true},

      children: [
        {path: '/login', name: 'login', component: () => import('../views/Auth/LoginView.vue')},
        {path: '/register', name: 'register', component: () => import('../views/Auth/RegisterView.vue')}
      ]
    },
    {
      path: '/admin',
      name: 'admin',

      component: () => import('../views/Admin/AdminView.vue'),
      meta: {requiresAuth: true},

      children: [
        {path: '/admin/users', name: 'admin.manager', component: () => import('../views/Admin/UsersView.vue')},
        {path: '/admin/profile', name: 'admin.profile', component: () => import('../views/Admin/ProfileView.vue')}
      ]
    }
  ]
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({name: 'login'})
  } else if (store.state.user.token && to.meta.isGuest) {
    next({name: 'admin'});
  } else {
    next();
  }
});

export default router;
