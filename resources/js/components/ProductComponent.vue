<template>
    <!--
    Heads up! 👋
  
    This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
  
    Plugins:
      - @tailwindcss/forms
  -->

    <section>
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
            <header>
                <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">
                    Colección de Productos
                </h2>

                <p class="mt-4 max-w-md text-gray-500">
                    Echa un vistazo a la tienda y las ultimas ediciones de Basic Tees, ¡nueva y mejorada con cuatro
                    aperturas!
                </p>
            </header>

            <div class="mt-8 block lg:hidden">
                <button
                    class="flex cursor-pointer items-center gap-2 border-b border-gray-400 pb-1 text-gray-900 transition hover:border-gray-600">
                    <span class="text-sm font-medium"> Filters & Sorting </span>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-4 w-4 rtl:rotate-180">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>

            <!-- Contendor Principal -->
            <div ref="filter" class="mt-4 lg:mt-8 lg:grid lg:grid-cols-4 lg:items-start lg:gap-8">
                <!-- Contendor Filtro -->
                <div class="hidden space-y-4 lg:block">
                    <div>
                        <label for="SortBy" class="block text-xs font-medium text-gray-700">
                            Ordenar Por
                        </label>

                        <select id="SortBy" class="mt-1 rounded border-gray-300 text-sm">
                            <option>Ordenar Por</option>
                            <option value="Title, DESC">Titulo, DESC</option>
                            <option value="Title, ASC">Titulo, ASC</option>
                            <option value="Price, DESC">Precio, DESC</option>
                            <option value="Price, ASC">Precio, ASC</option>
                        </select>
                    </div>

                    <div>
                        <p class="block text-xs font-medium text-gray-700">Filtros</p>

                        <div class="mt-1 space-y-2">
                            <details
                                class="overflow-hidden rounded border border-gray-300 [&_summary::-webkit-details-marker]:hidden">
                                <summary
                                    class="flex cursor-pointer items-center justify-between gap-2 p-4 text-gray-900 transition">
                                    <span class="text-sm font-medium"> Categoria </span>

                                    <span class="transition group-open:-rotate-180">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </summary>

                                <div class="border-t border-gray-200 bg-white">
                                    <header class="flex items-center justify-between p-4">
                                        <span class="text-sm text-gray-700"> 0 Seleccionados </span>

                                        <button type="button" class="text-sm text-gray-900 underline underline-offset-4">
                                            Limpiar
                                        </button>
                                    </header>

                                    <ul class="space-y-1 border-t border-gray-200 p-4">
                                        <li>
                                            <label for="FilterInStock" class="inline-flex items-center gap-2">
                                                <input type="checkbox" id="FilterInStock"
                                                    class="h-5 w-5 rounded border-gray-300" />

                                                <span class="text-sm font-medium text-gray-700">
                                                    categoria 1
                                                </span>
                                            </label>
                                        </li>

                                        <li>
                                            <label for="FilterPreOrder" class="inline-flex items-center gap-2">
                                                <input type="checkbox" id="FilterPreOrder"
                                                    class="h-5 w-5 rounded border-gray-300" />

                                                <span class="text-sm font-medium text-gray-700">
                                                    categoria 2
                                                </span>
                                            </label>
                                        </li>

                                        <li>
                                            <label for="FilterOutOfStock" class="inline-flex items-center gap-2">
                                                <input type="checkbox" id="FilterOutOfStock"
                                                    class="h-5 w-5 rounded border-gray-300" />

                                                <span class="text-sm font-medium text-gray-700">
                                                    categoria 3
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </details>

                            <details
                                class="overflow-hidden rounded border border-gray-300 [&_summary::-webkit-details-marker]:hidden">
                                <summary
                                    class="flex cursor-pointer items-center justify-between gap-2 p-4 text-gray-900 transition">
                                    <span class="text-sm font-medium"> Precio </span>

                                    <span class="transition group-open:-rotate-180">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </summary>

                                <div class="border-t border-gray-200 bg-white">
                                    <header class="flex items-center justify-between p-4">
                                        <span class="text-sm text-gray-700">
                                            El precio más alto es de 600 dólares
                                        </span>

                                        <button type="button" class="text-sm text-gray-900 underline underline-offset-4">
                                            Limpiar
                                        </button>
                                    </header>

                                    <div class="border-t border-gray-200 p-4">
                                        <div class="flex justify-between gap-4">
                                            <label for="FilterPriceFrom" class="flex items-center gap-2">
                                                <span class="text-sm text-gray-600">$</span>

                                                <input type="number" id="FilterPriceFrom" placeholder="Desde"
                                                    class="w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                                            </label>

                                            <label for="FilterPriceTo" class="flex items-center gap-2">
                                                <span class="text-sm text-gray-600">$</span>

                                                <input type="number" id="FilterPriceTo" placeholder="Hasta"
                                                    class="w-full rounded-md border-gray-200 shadow-sm sm:text-sm" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </details>


                        </div>
                    </div>
                </div>

                <!-- contenedor de tarjetas de productos -->

                <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 overflow-auto"
                    @scroll="handleScroll">
                    <a href="#" class="group relative block overflow-hidden" v-for="product in products" :key="product.id">

                        <img :src="'storage/' + product.product_image.split(',')[0].trim()" alt=""
                            class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
                            width="256" height="256" />


                        <div class="relative border border-gray-100 bg-white p-6">


                            <h3 class="mt-4 text-lg font-medium text-gray-900">{{ product.name }}</h3>

                            <p class="mt-1.5 text-sm text-gray-700">{{ product.price }}</p>
                            <p class="mt-1.5 text-sm text-gray-700">{{ product.categoria.name}}</p>


                            <Button
                                class="block w-full rounded p-4 text-base font-medium font-semibold transition hover:scale-105 mt-4">
                                Añadir al carrito
                            </Button>

                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';
import Button from '../components/Button.vue'
export default {
    components: {
        Button
    },

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