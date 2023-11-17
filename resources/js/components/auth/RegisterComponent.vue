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
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" method="POST" v-on:submit.prevent="register">
                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nombres</label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" required="" v-model="name"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                            placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">

                        <input id="email" name="email" type="email" v-model="email" autocomplete="email" required=""
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                    <div class="mt-2">
                        <ErrorText v-if="errors && errors.email" :message="errors.email[0]" />
                    </div>

                </div>
                <div class="flex space-x-4">
                    <div class="flex-1">
                        <label for="document_type" class="block text-sm font-medium leading-6 text-gray-900">Tipo de
                            documento</label>
                        <div class="mt-2">
                            <select id="document_type" name="document_type"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="dni">DNI</option>
                                <option value="passport">Pasaporte</option>
                                <option value="license">Licencia de conducir</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex-1">
                        <label for="document_number" class="block text-sm font-medium leading-6 text-gray-900">Número de
                            documento</label>
                        <div class="mt-2">
                            <input id="document_number" name="document_number" type="text" required=""
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <div class="flex-1">
                        <label for="document_type" class="block text-sm font-medium leading-6 text-gray-900">Departamento
                        </label>
                        <div class="mt-2">
                            <select id="department" name="department" v-model="selectedDepartment"
                                @change="loadCities(selectedDepartment)"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option v-for="department in departments" :key="department.id" :value="department.id">
                                    {{ department.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="flex-1">
                        <label for="city" class="block text-sm font-medium leading-6 text-gray-900">Ciudad
                        </label>
                        <div class="mt-2">
                            <select id="city" name="city"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option v-for="city in cities" :key="city.id" :value="city.id">
                                    {{ city.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">

                        <input id="" name="" type="email" v-model="email" autocomplete="email" required=""
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                    <div class="mt-2">
                        <ErrorText v-if="errors && errors.email" :message="errors.email[0]" />
                    </div>

                </div>


                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>

                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" v-model="password"
                            autocomplete="current-password" required=""
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                    <div class="mt-2">
                        <ErrorText v-if="errors && errors.password" :message="errors.password[0]" />
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <label for="acceptTerms" class="flex items-center cursor-pointer">
                        <input id="acceptTerms" type="checkbox" v-model="acceptedTerms"
                            class="form-checkbox text-indigo-600 focus:ring-indigo-500 h-4 w-4" />
                        <p class="ml-3">Acepto los</p>
                        <span class="ml-1 font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
                            @click.prevent="showModal = true">
                            términos y condiciones
                        </span>
                    </label>
                </div>
                
                <!-- componente de modal términos y condiciones -->
                <TermsModal v-if="showModal" @close="showModal = false" />

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Registrarse</button>
                </div>
            </form>


        </div>
    </div>
    <div></div>
</template>
  



<script>
import axios from 'axios';
import ErrorText from '../auth/error.vue'
import TermsModal from '../auth/TermsModal.vue';

export default {
    components: {
        ErrorText,
        TermsModal
    },


    data() {
        return {
            name: '',
            email: '',
            password: '',
            errors: '',
            acceptedTerms: '',
            cities: [],
            departments: [],
            showModal: false,

            selectedDepartment: null,

        };
    },
    methods: {
        register() {

            if (!this.acceptedTerms) {
                // Muestra un mensaje o realiza alguna acción si los términos no son aceptados
                alert('Debes aceptar los términos y condiciones para registrarte.');
                return;
            } else {
                let cart = localStorage.getItem('cart');
                axios.post('/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    cart: cart
                }).then(response => {
                    this.$router.push({ path: '/' });
                    location.reload();
                    console.log(response.data);
                })
                    .catch(error => {
                        this.errors = error.response.data.errors
                        console.log(this.errors)
                    });
            }

        },
        async loadCities(departmentId) {
            const response = await axios.get(`/cities/${departmentId}`);
            this.cities = response.data;

        },
        async loadDepartments() {
            const response = await axios.get('/departments');
            this.departments = response.data;
        },


    },

    watch: {
        documentType(newVal) {
            if (newVal) {
                this.loadCities(newVal);
            }
        },
    },
    created() {
        this.loadDepartments();
    },
};
</script>