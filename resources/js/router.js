import { createRouter, createWebHistory } from "vue-router";

import home from './pages/home.vue';
import contacts from './pages/contacts.vue';
import About from './pages/About.vue';
import Err from './pages/Err.vue';
import Recenti from './pages/Recenti.vue';
import Show from './pages/Show.vue';

const router = createRouter({
  linkExactActiveClass: 'active',
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      component: home
    },
    {
      path: '/chi_siamo',
      name: 'About',
      component: About
    },
    {
      path: '/contatti',
      name: 'contacts',
      component: contacts
    },
    {
      path:'/recenti',
      name:'Recenti',
      component: Recenti
    },
    {
      path: '/recenti/show/:slug',
      name: 'Show',
      component: Show
    },
    {
      path: '/:pathMatch(.*)*',
      component: Err
    }
  ]
});

export { router };