<template>
  <section>
    <div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:px-8">
      <header>
        <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">
          Categorias Disponibles
        </h2>

        <p class="max-w-md mt-4 text-gray-500">
          Todas las categorias aquí !!
        </p>
      </header>

      <ul class="grid gap-4 mt-8 sm:grid-cols-2 lg:grid-cols-4">

        <li v-for="categoria in categorias" :key="categoria.id">
          <router-link :to="{ name: 'categoriaComponent', params: { categoryId: categoria.id } }"
            class="block overflow-hidden group">
            <img :src="'/storage/' + categoria.category_image" alt="Imagen de la categoría"
              class="h-[350px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[450px]" />
            <div class="relative pt-3 bg-white">
              <h3 class="text-xs text-gray-700 group-hover:underline group-hover:underline-offset-4">
                Basic Tee
              </h3>

              <p class="mt-2">
                <span class="sr-only"> Regular Price </span>
                <span class="tracking-wider text-gray-900"> {{ categoria.name }} </span>
                <!-- <router-link :to="{ name: 'categoriaComponent', params: { categoryId: categoria.id } }">{{ categoria.name }}</router-link> -->

              </p>
            </div>

          </router-link>
        </li>

      </ul>
    </div>
  </section>
</template>

<script>
import axios from 'axios';
import { eventBus } from '../eventBus';

export default {
  data() {
    return {
      categorias: [],
    };
  },
  created() {
    this.fetchCategorias();
   
  },



  methods: {
    fetchCategorias() {
      axios.get('/categorias')
        .then(response => {
          this.categorias = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },

    categorySelect(categoria) {
      const name = categoria.name
      eventBus.emit('selectCategory', name)
    },


  



  },
};
</script>

