<!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
  <!--
      This example requires updating your template:
  
      ```
      <html class="h-full bg-white">
      <body class="h-full">
      ```
    -->
  <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
        alt="Your Company" />
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Ingresa a tu cuenta</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" @submit="login($event)" method="POST">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" autocomplete="email" required="" v-model="email"
              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
          <div class="mt-2">
            <ErrorText v-if="errorMessage" :message="errorMessage.email[0]" />
          </div>

        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            <div class="text-sm">
              <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
            </div>
          </div>
          <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" required=""
              v-model="password"
              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
          <div class="mt-2">
            <ErrorText v-if="errorMessage" :message="errorMessage.email[0]" />
          </div>

        </div>

        <div>
          <button type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
            in</button>
        </div>
      </form>

      <p class="mt-10 text-center text-sm text-gray-500">
        No tienes cuenta?
        <router-link to="/register" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Registrate
          aqui</router-link>
      </p>
    </div>
  </div>
</template>
  

<script>
import axios from 'axios';
import ErrorText from '../auth/error.vue'


export default {
  components: {
    ErrorText,
  },

  props: {
    message: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      email: '',
      password: '',
      csrfToken: '',
      errorMessage: '',
    };
  },
  created() {

    this.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log('CSRF Token:', this.csrfToken);
  },
  methods: {
    login(event) {
      event.preventDefault();

      axios.post('/login', {
        email: this.email,
        password: this.password
      }, {
        headers: {
          'X-CSRF-TOKEN': this.csrfToken
        }
      })
        .then(response => {
          console.log(response.data);
          location.reload();
          this.$router.push('/');

          // let cart = JSON.parse(localStorage.getItem)
          // if (cart.length > 0){
          //   axios.post('/cart/', {$productDatas})

          // }else {


          // }

        })
        .catch(error => {
          if (error.response && error.response.data && error.response.data.errors) {
            this.errorMessage = error.response.data.errors;
            console.log(error.response.data)
          } else {
            this.errorMessage = 'Ha ocurrido un error al iniciar sesión. Por favor, inténtalo de nuevo.';
          }
        });
    }
  }
};
</script>
