<!-- <template>
  <div style="padding: 40px;">
    <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Lista de Productos</h1>
    <div class="rounded-lg border border-gray-200">
      <div class="overflow-x-auto rounded-t-lg">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
          <thead class="ltr:text-left rtl:text-right">
            <tr>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Nombre</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Descripción</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Categoria</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Precio</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Stock</th>

              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Acciones</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-200">
            <tr v-for="product in products" :key="product.id">
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ product.name }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ product.description }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ product.categoria.name }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ product.price }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ product.stock }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">

                <router-link :to="{ name: 'productEdit', params: { id: product.id } }"
                  class="bg-emerald-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1">Editar</router-link>
                <button class="bg-red-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1"
                  @click="deleteProduct(product.id)">Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="mt-4">
      <router-link :to="{ path: '/dashboard/product/create' }"
        class="bg-blue-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1">Crear Producto</router-link>
    </div>
  </div>
</template> -->
<template>
  <!-- <div style="padding: 40px;">
    <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Lista de Productos</h1>
    <div class="rounded-lg border border-gray-200 overflow-x-auto">
      <div class="overflow-x-auto rounded-t-lg">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
          <thead class="ltr:text-left rtl:text-right">
            <tr>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Nombre</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 sm:table-cell">Descripción</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Categoria</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Precio</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Stock</th>

              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Acciones</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-200">
            <tr v-for="product in products" :key="product.id">
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ product.name }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700 sm:table-cell">{{ product.description }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ product.categoria.name }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ product.price }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ product.stock }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">

                <router-link :to="{ name: 'productEdit', params: { id: product.id } }"
                  class="bg-emerald-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1">Editar</router-link>
                <button class="bg-red-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1"
                  @click="deleteProduct(product.id)">Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="mt-4">
      <router-link :to="{ path: '/dashboard/product/create' }"
        class="bg-blue-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1">Crear Producto</router-link>
    </div>
  </div> -->

  <div class="flex flex-col">
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <table class="min-w-full text-left text-sm font-light">
          <thead class="border-b font-medium dark:border-neutral-500">
            <tr>
              <th scope="col" class="px-6 py-4">Nombre</th>
              <th scope="col" class="px-6 py-4">Descripción</th>
              <th scope="col" class="px-6 py-4">Categoria</th>
              <th scope="col" class="px-6 py-4">Precio</th>
              <th scope="col" class="px-6 py-4">Stock</th>
              
              <th scope="col" class="px-6 py-4">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b dark:border-neutral-500" v-for="product in products" :key="product.id">
              <td class="whitespace-nowrap px-6 py-4 font-medium">{{ product.name }}</td>
              <td class="whitespace-nowrap px-6 py-4">{{ product.description }}</td>
              <td class="whitespace-nowrap px-6 py-4">{{ product.categoria.name }}</td>
              <td class="whitespace-nowrap px-6 py-4">{{ product.price }}</td>
              <td class="whitespace-nowrap px-6 py-4">{{ product.stock }}</td>
              <td class="whitespace-nowrap px-6 py-4">
                <router-link :to="{ name: 'productEdit', params: { id: product.id } }"
                  class="bg-emerald-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1">Editar</router-link>
                <button class="bg-red-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1"
                  @click="deleteProduct(product.id)">Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="mt-4">
      <router-link :to="{ path: '/dashboard/product/create' }"
        class="bg-blue-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1">Crear Producto</router-link>
    </div>
</div>


</template>
  
<script>
import axios from 'axios';


export default {
  data() {
    return {
      products: [],
    };
  },
  created() {
    this.fetchProducts();
  },
  methods: {
    fetchProducts() {

      axios.get('/productos')
        .then(response => {
          this.products = response.data
        })
        .catch(error => {
          console.error(error);
        });
    },
    deleteProduct(id) {
      if (confirm("Estas seguro que quieres eliminar este producto?")) {
        axios.delete(`/productos/${id}`)
          .then(response => {
            this.fetchProducts();
          })
          .catch(error => {
            console.error(error);
          });
      }
    },
  },
};
</script>
