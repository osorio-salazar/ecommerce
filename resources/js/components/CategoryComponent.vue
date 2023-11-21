<template>
  <div class="container mx-auto my-8">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <h2 class="text-2xl font-bold mb-4">Productos de la Categoría</h2>

      <div v-if="productos.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div v-for="producto in productos" :key="producto.id"
          class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md">
          <img :src="'/storage/productos/' + producto.product_image.split(',')[0].trim()" class="w-full h-48 object-cover"
            alt="Imagen de producto">
          <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ producto.name }}</div>
            <p class="text-gray-700 text-base">{{ producto.description }}</p>
            <p class="text-gray-900 text-lg mt-2">${{ producto.price }}</p>
          </div>
          <Button @click="addProduct(producto)"
            class="block w-full rounded p-4 text-base font-medium font-semibold transition hover:scale-105 mt-4">
            Añadir al carrito
          </Button>
        </div>
      </div>

      <div v-else class="text-center">
        <p class="text-gray-700">No hay productos en esta categoría.</p>
      </div>

      <div class="mt-auto flex justify-end">
        <router-link to="/" class="bg-blue-500 text-white py-2 px-4 rounded mt-3">
          Volver
        </router-link>
      </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios';
import Button from '../components/Button.vue'
import { eventBus } from '../eventBus';


export default {
  components: {
    Button
  },




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
    eventBus.on('product-add', this.addProduct);
    
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
    addProduct(producto) {
      const productDatas = {
        id: producto.id,
        name: producto.name,
        price: producto.price,
        product_image: producto.product_image.split(',')[0].trim(),
        cantidad: 1
      }


      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      let productIndex = cart.findIndex(p => p.id === producto.id);
      console.log(cart);

      if (productIndex !== -1) {
        cart[productIndex].cantidad += 1;
      } else {
        producto.cantidad = 1;
        cart.push(productDatas);
      }

      if (this.user) {
        axios.post('/cart', { productDatas })
          .then(response => {
            console.log(response);
          })
      }
      localStorage.setItem('cart', JSON.stringify(cart));
      eventBus.emit('product-added');


    },






    
  },
}
</script>