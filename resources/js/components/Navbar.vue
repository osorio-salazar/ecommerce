

<template>
  <div class="bg-gray-900 text-gray-100 py-3.5 px-6 shadow md:flex justify-between items-center" >


    <div class="flex items-center">
      <span class="text-green-500 text-xl mr-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </span>
      <h1 class="text-xl">
        Ecommerce
      </h1>
      <span class="absolute md:hidden right-6 top-1.5 cursor-pointer text-4xl" @click="oopen">
        <div class="flex items-center justify-center w-10 h-10  rounded-full">
          <svg v-if="openNav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </div>
      </span>
    </div>


    <ul class="md:flex md:items-center md:px-0 px-3 md:pb-0 pb-10 md:static absolute 
    bg-gray-900 md:w-auto w-full top-14 duration-700 ease-in" :class="[openNav ? 'left-0 header-open' : 'top-[-40%]']" >
      <li class="md:mx-4 md:my-0 my-6" v-for="link in Links">
        <a :href="link.link" class="text-xl hover:text-blue-500">{{ link.name }}</a>
      </li>

      <Button>

        Iniciar Sesion
      </Button>
      <span class="mx-2"></span>
      <Button>
        Registrarse
      </Button>


    </ul>


  </div>
</template>



<script>

import Button from '../components/Button.vue'
import { ref } from 'vue';


export default {
  components: {
    Button
  },

  setup() {
    const openNav = ref(false);

    let Links = [
      { name: 'Productos', link: '#' },
      { name: 'Categorias', link: '#' },

    ]

    function oopen() {
      openNav.value = !openNav.value;
      console.log(openNav.value);
    }
    return {
      Links, openNav, oopen
    }
  }

}
</script>

