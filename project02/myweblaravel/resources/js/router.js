import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import Product from './components/Product.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Dashboard from './components/Dashboard.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/product', component: Product },
  { path: '/login', component: Login },
  { path: '/register', component: Register },
  { path: '/dashboard', component: Dashboard },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
