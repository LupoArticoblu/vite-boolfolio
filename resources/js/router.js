import { createRouter, createWebHistory } from "vue-router";

import home from './pages/home.vue';
import contacts from './pages/contacts.vue';
import About from './pages/About.vue';

const router = createRouter({

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
    }
  ]
});

export { router };