
<template>
  <div class="bg-gray-900 text-gray-100 py-3.5 px-6 shadow md:flex justify-between items-center">


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
    bg-gray-900 md:w-auto w-full top-14 duration-700 ease-in" :class="[openNav ? 'left-0 header-open' : 'top-[-40%]']">

      <router-link to="/products">
        <li class="md:mx-4 md:my-0 my-6">
          <a class="text-xl hover:text-blue-500">Productos</a>
        </li>
      </router-link>

      <router-link to="/categorias">
        <li class="md:mx-4 md:my-0 my-6">
          <a class="text-xl hover:text-blue-500">Categorias</a>
        </li>
      </router-link>

      <div>
        
      </div>

      <router-link to="/login" v-if="userIsLogin()">
        <Button>
          Iniciar Sesion
        </Button>
      </router-link>
      <span class="mx-2"></span>
      <router-link to="/register" v-if="userIsLogin()">
        <Button>
          Registrarse
        </Button>
      </router-link>

      <div v-else>
        <div>
          <!-- ... -->
          <div class="relative inline-block text-left">
            <button ref="dropdownButton" type="button" @click="isOpen = !isOpen"
              class="inline-flex justify-center w-full rounded-md bg-gray-800 text-white shadow-sm px-4 py-2 text- font-medium hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
              id="options-menu" aria-haspopup="true" aria-expanded="true"> {{ user.name }}

              <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd" />
              </svg>
            </button>

            <div v-if="isOpen"
              class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-gray-800 text-white ring-1 ring-black ring-opacity-5">
              <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                <router-link to="/dashboard"
                  class="block px-4 py-2 text-sm text-white hover:bg-gray-700 hover:text-gray-300"
                  role="menuitem">Dashboard</router-link>
                <router-link to="/" class="block px-4 py-2 text-sm text-white hover:bg-gray-700 hover:text-gray-300"
                  role="menuitem" @click="logout">Logout</router-link>
              </div>
            </div>
          </div>
          <!-- ... -->
        </div>
      </div>
    </ul>
  </div>
</template>




<script>

import axios from 'axios';
import Button from '../components/Button.vue'
import { ref } from 'vue';


export default {
  components: {
    Button
  },

  data() {
    return {
      isOpen: false,
      user: '',
    }

  },

  setup() {
    const openNav = ref(false);

    let Links = [
      { name: 'Productos', link: '/products' },
      { name: 'Categorias', link: '/categorias' },

    ]

    function oopen() {
      openNav.value = !openNav.value;
      console.log(openNav.value);
    }
    return {
      Links, openNav, oopen
    }
  },
  created() {
    this.userAuth();
  },


  methods: {
    userAuth() {

      axios.get('/getAuth')
        .then(response => {
          this.user = response.data;
        })
    },
    logout() {
      axios.post('/logout')
        .then(() => {

          window.location.href = '/';
        })
        .catch(error => {
          console.log(error);
        });
    },
    userIsLogin() {

      if (this.user.id > 0) {
        return false
      } else {
        return true
      }

    },

    closeDropdown() {
      if (this.isOpen && event.target !== this.$refs.dropdownButton) {
        this.isOpen = false;
      }
    },

  },
  mounted() {
    window.addEventListener('click', this.closeDropdown);
  },
  beforeDestroy() {
    window.removeEventListener('click', this.closeDropdown);
  },


}
</script>


