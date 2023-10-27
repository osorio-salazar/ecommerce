<template>
  <div style="padding: 40px;">
    <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Lista de Productos</h1>
    <div class="rounded-lg border border-gray-200">
      <div class="overflow-x-auto rounded-t-lg">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
          <thead class="ltr:text-left rtl:text-right">
            <tr>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Nombre</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Descripción</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Precio</th>
              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Stock</th>

              <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Acciones</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-200">
            <tr v-for="product in products" :key="product.id">
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ product.name }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ product.description }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ product.price }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ product.stock }}</td>
              <td class="whitespace-nowrap px-4 py-2 text-gray-700">

                <button class="bg-sky-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1">Ver</button>
                <router-link :to="{ name: 'productEdit', params: { id: product.id } }"
                  class="bg-emerald-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1">Editar</router-link>


                <button class="bg-red-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1">Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
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

          console.log(this.products = response.data);
        })
        .catch(error => {
          console.error(error);
        });
    },
  },
};
</script>
