import { createRouter, createWebHistory } from 'vue-router';
import homeComponent from '../views/homeComponent.vue';
import criarComponent from '../views/criarComponent.vue'



const routes = [
  {
    path: '/',
    component: homeComponent,
   
  },
  {
    path:'/criar',
    component:criarComponent
  },
  
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
