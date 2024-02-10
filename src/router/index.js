import { createRouter, createWebHistory } from 'vue-router'
import TheWelcome from '../components/TheWelcome.vue'
import Dashboard from '../views/Dashboard.vue'
import UpdateBook from '../components/UpdateBook.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: 'home',
      component: TheWelcome
    },
    {
      path: "/dashboard",
      name: 'dashboard',
      component: Dashboard
    },
    {
      path: "/updateBook",
      name: 'UpdateBook',
      component: UpdateBook
    }
  ]
})

export default router
