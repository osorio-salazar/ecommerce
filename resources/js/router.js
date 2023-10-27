import { createRouter, createWebHistory } from 'vue-router';


import Inicio from '../js/components/InicioComponent.vue'
import ProductComponent from '../js/components/ProductComponent.vue'
// rutas crud admin productos
import ProductCreatePage from '../js/components/admin/product/ProductCreatePage.vue'
import ProductEditPage from '../js/components/admin/product/ProductEditPage.vue'
import ProductListPage from '../js/components/admin/product/ProductListPage.vue'
import RegisterComponent from '../js/components/auth/RegisterComponent.vue'

const routes = [
  {
    path: '/',
    name: 'Inicio',
    component: Inicio
  }, // store
  {
    path: '/register',
    name: 'registerComponent',
    component: RegisterComponent


  },
  {
    path: '/products',
    name: 'e-products',
    component: ProductComponent
  },
  { // CRUD admin products
    path: '/admin/product/create',
    name: 'productCreate',
    component: ProductCreatePage
  },
  {
    path: '/admin/product/edit/:id',
    name: 'productEdit',
    component: ProductEditPage
  },
  {
    path: '/admin/product/list',
    name: 'productList',
    component: ProductListPage
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router;
