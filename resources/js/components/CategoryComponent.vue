<template>
    <div class="container mx-auto my-8">
      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-2xl font-bold mb-4">Productos de la Categoría</h2>
  
        <div v-if="productos.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <div v-for="producto in productos" :key="producto.id" class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md">
            <img :src="'/storage/productos/' + producto.product_image.split(',')[0].trim()" class="w-full h-48 object-cover" alt="Imagen de producto">
            <div class="px-6 py-4">
              <div class="font-bold text-xl mb-2">{{ producto.name }}</div>
              <p class="text-gray-700 text-base">{{ producto.description }}</p>
              <p class="text-gray-900 text-lg mt-2">${{ producto.price }}</p>
            </div>
          </div>
        </div>
  
        <div v-else class="text-center">
          <p class="text-gray-700">No hay productos en esta categoría.</p>
        </div>
      </div>
    </div>
  </template>
  

<script>
import axios from 'axios';

export default {
    mounted() {
        console.log('Component mounted.')
    },
    props: ['categoryId'],
    data() {
        return {
            productos: [],
        };
    },
    created() {
        this.fetchProductosPorCategoria();
    },
    methods: {
        fetchProductosPorCategoria() {
            // Realiza una solicitud para obtener los productos de la categoría
            axios.get(`/productos?category_id=${this.categoryId}`)
                .then(response => {
                    // this.productos = response.data;
                    this.productos = response.data.filter(producto => producto.category_id == this.categoryId);
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
}
</script>