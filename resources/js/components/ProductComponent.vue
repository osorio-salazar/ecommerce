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
            <div class="mt-4 lg:mt-8 lg:grid lg:grid-cols-4 lg:items-start lg:gap-8">
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

                            <details
                                class="overflow-hidden rounded border border-gray-300 [&_summary::-webkit-details-marker]:hidden">
                                <summary
                                    class="flex cursor-pointer items-center justify-between gap-2 p-4 text-gray-900 transition">
                                    <span class="text-sm font-medium"> Color </span>

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
                                            <label for="FilterRed" class="inline-flex items-center gap-2">
                                                <input type="checkbox" id="FilterRed"
                                                    class="h-5 w-5 rounded border-gray-300" />

                                                <span class="text-sm font-medium text-gray-700">
                                                    Rojo
                                                </span>
                                            </label>
                                        </li>

                                        <li>
                                            <label for="FilterBlue" class="inline-flex items-center gap-2">
                                                <input type="checkbox" id="FilterBlue"
                                                    class="h-5 w-5 rounded border-gray-300" />

                                                <span class="text-sm font-medium text-gray-700">
                                                    Azul
                                                </span>
                                            </label>
                                        </li>

                                        <li>
                                            <label for="FilterGreen" class="inline-flex items-center gap-2">
                                                <input type="checkbox" id="FilterGreen"
                                                    class="h-5 w-5 rounded border-gray-300" />

                                                <span class="text-sm font-medium text-gray-700">
                                                    Verde
                                                </span>
                                            </label>
                                        </li>

                                        <li>
                                            <label for="FilterOrange" class="inline-flex items-center gap-2">
                                                <input type="checkbox" id="FilterOrange"
                                                    class="h-5 w-5 rounded border-gray-300" />

                                                <span class="text-sm font-medium text-gray-700">
                                                    Naranja
                                                </span>
                                            </label>
                                        </li>

                                        <li>
                                            <label for="FilterPurple" class="inline-flex items-center gap-2">
                                                <input type="checkbox" id="FilterPurple"
                                                    class="h-5 w-5 rounded border-gray-300" />

                                                <span class="text-sm font-medium text-gray-700">
                                                    Morado
                                                </span>
                                            </label>
                                        </li>

                                        <li>
                                            <label for="FilterTeal" class="inline-flex items-center gap-2">
                                                <input type="checkbox" id="FilterTeal"
                                                    class="h-5 w-5 rounded border-gray-300" />

                                                <span class="text-sm font-medium text-gray-700">
                                                    Amarillo
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </details>
                        </div>
                    </div>
                </div>

                <!-- contenedor de tarjetas de productos -->
                <div class="lg:col-span-3">
                    <ul class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- tarjeta -->
                        <li>
                            <a href="#" class="group block overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                                    alt=""
                                    class="h-[350px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[450px]" />

                                <div class="relative bg-white pt-3">
                                    <h3 class="text-xs text-gray-700 group-hover:underline group-hover:underline-offset-4">
                                        Basic Tee
                                    </h3>

                                    <p class="mt-2">
                                        <span class="sr-only"> Regular Price </span>

                                        <span class="tracking-wider text-gray-900"> £24.00 GBP </span>
                                    </p>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="group block overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                                    alt=""
                                    class="h-[350px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[450px]" />

                                <div class="relative bg-white pt-3">
                                    <h3 class="text-xs text-gray-700 group-hover:underline group-hover:underline-offset-4">
                                        Basic Tee
                                    </h3>

                                    <p class="mt-2">
                                        <span class="sr-only"> Regular Price </span>

                                        <span class="tracking-wider text-gray-900"> £24.00 GBP </span>
                                    </p>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="group block overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                                    alt=""
                                    class="h-[350px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[450px]" />

                                <div class="relative bg-white pt-3">
                                    <h3 class="text-xs text-gray-700 group-hover:underline group-hover:underline-offset-4">
                                        Basic Tee
                                    </h3>

                                    <p class="mt-2">
                                        <span class="sr-only"> Regular Price </span>

                                        <span class="tracking-wider text-gray-900"> £24.00 GBP </span>
                                    </p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {

}
</script>