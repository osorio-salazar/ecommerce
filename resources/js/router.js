import { createRouter, createWebHistory } from 'vue-router';
import axios from 'axios';

import Inicio from '../js/components/InicioComponent.vue'
import ProductComponent from '../js/components/admin/product/ProductComponent.vue'
// rutas crud admin productos
import ProductCreatePage from '../js/components/admin/product/ProductCreatePage.vue'
import ProductEditPage from '../js/components/admin/product/ProductEditPage.vue'
import ProductListPage from '../js/components/admin/product/ProductListPage.vue'
import ProductDetails from '../js/components/admin/product/ProductDetails.vue'


import CategoryCreatePage from '../js/components/admin/category/CategoryCreatePage.vue'
import CategoryEditPage from '../js/components/admin/category/CategoryEditPage.vue'
import CategoryListPage from '../js/components/admin/category/CategoryListPage.vue'

import RegisterComponent from '../js/components/auth/RegisterComponent.vue'
import LoginComponent from '../js/components/auth/LoginComponent.vue'
import CategoryComponent from '../js/components/CategoryComponent.vue'
import Dashboard from '../js/components/admin/Dashboard.vue'


const routes = [
  {
    path: '/',
    name: 'Inicio',
    component: Inicio
  }, // store
  {
    path: '/categorias',
    name: 'categoriaComponent',
    component: CategoryComponent
  }, // store

  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: { requiresAuth: true },
    children: [
      {
        path: 'product/list',
        component: ProductListPage,
        meta: { requiresAuth: true, requiredRole: 1 },
      },

      {
        path: 'product/create',
        component: ProductCreatePage,
        meta: { requiresAuth: true, requiredRole: 1 },

      },
      {

        path: 'product/edit/:id',
        name: 'productEdit',
        component: ProductEditPage,
        meta: { requiresAuth: true, requiredRole: 1 },

      },
      { // CRUD admin categories
        path: 'category/create',
        name: 'categoryCreate',
        component: CategoryCreatePage,
        meta: { requiresAuth: true, requiredRole: 1 },
      },
      {
        path: 'category/edit/:id',
        name: 'categoriaEdit',
        component: CategoryEditPage,
        meta: { requiresAuth: true, requiredRole: 1 },
      },
      {
        path: 'category/list',
        name: 'categoryList',
        component: CategoryListPage,
        meta: { requiresAuth: true, requiredRole: 1 },
      },
    ]
  },

  {
    path: '/login',
    name: 'loginComponent',
    component: LoginComponent
  },
  {
    path: '/register',
    name: 'registerComponent',
    component: RegisterComponent
  },
  {
    path: '/products',
    name: 'e-products',
    component: ProductComponent,
  },
  {
    path: '/products/:name',
    name: 'ProductDetails',
    component: ProductDetails,
    props: route => ({ id: route.query.id })
  }

];

const router = createRouter({
  history: createWebHistory(),
  routes,
  mode: "history"
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // Verifica si la ruta o una de sus rutas padres requiere autenticación
    axios.get('/getInfoUser')
      .then(response => {
        if (response.data == ('0')) {
          console.log('user no logueado');
          next('/login');
        } else {
          const user = response.data.user;
          const roleId = response.data.role_id;


          if (to.meta.requiredRole && to.meta.requiredRole !== roleId) {
            console.log('user no tiene el rol necesario');
            next('/dashboard');
          } else {
            next();
          }
        }
      })
      .catch(error => {
        console.log(error);
        next('/login');
      });
  } else {
    next();
  }
});

export default router;
