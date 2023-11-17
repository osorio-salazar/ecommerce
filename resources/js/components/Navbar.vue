
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
      <router-link to="/">
        <h1 class="text-xl">
          Ecommerce
        </h1>
      </router-link>
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
    bg-gray-900 md:w-auto w-full top-14 duration-700 ease-in" :class="[openNav ? 'left-0 header-open' : 'top-[-40%]']"
      style="z-index: 90;">


      <router-link to="/">
        <li class="md:mx-4 md:my-0 my-6">
          <a class="text-xl hover:text-blue-500">Inicio</a>
        </li>
      </router-link>

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



      <button @click="openCart">
        <Cart ref="cart" />
        <li class="md:mx-4 md:my-0 my-6">
          <div style="position: relative; display: inline-block;">
            <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
              class="bi bi-cart" viewBox="0 0 16 16">
              <path
                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
                fill="white"></path>
            </svg>
            <span
              style="position: absolute; top: -10px; right: -10px; background-color: red; color: white; border-radius: 50%; width: 20px; height: 20px; text-align: center; line-height: 20px;">
              {{ cartQuantity }}
            </span>
          </div>
        </li>
      </button>
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

              <!-- ... -->

            </button>
            <div v-if="isOpen"
              class="origin-top-right md:absolute md:right-0 md:mt-2 w-56 rounded-md shadow-lg bg-gray-800 text-white ring-1 ring-black ring-opacity-5 md:left-auto left-0">
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
import Cart from '../components/cart/cart.vue'
import { eventBus } from '../eventBus';


export default {
  components: {
    Button,
    Cart
  },

  data() {
    return {
      isOpen: false,
      user: '',
      cartQuantity: 0


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
    eventBus.on('product-added', this.openCart);
    eventBus.on('product-added', this.updateCartQuantity);
    eventBus.on('product-delete', this.updateCartQuantity);
    this.updateCartQuantity();
    this.userAuth()
  },



  methods: {

    handleCartOpen() {

    },
    openCart() {
      this.$refs.cart.openModal()

    },

    fetchCart() {
      axios.get('/cart')
        .then(response => {
          localStorage.setItem('cart', JSON.stringify(response.data));

        })
        .catch(error => {
          console.error(error);
        });
    },


    getCart() {
      return JSON.parse(localStorage.getItem('cart')) || [];
    },
    updateCartQuantity() {
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      this.cartQuantity = cart.length;
    },



    userAuth() {
      axios.get('/getAuth')
        .then(response => {
          this.user = response.data;
          if (this.user) {
            this.fetchCart();
          }

        })
    },
    logout() {
      axios.post('/logout')
        .then(() => {
          localStorage.clear();
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


