
import { createRouter, createWebHistory } from 'vue-router';


import  Inicio from '../js/components/InicioComponent.vue'
import ProductComponent from '../js/components/ProductComponent.vue'

const routes = [
  {
    path: '/',
    name: 'Inicio',
    component: Inicio
   },
   {
    path: '/products',
    name: 'e-products',
    component: ProductComponent
   },
  
];

const router = createRouter({
    history: createWebHistory(),
    routes
  })

export default router;
