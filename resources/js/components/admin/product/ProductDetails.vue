<template>
    <section class="overflow-hidden bg-white py-11 font-poppins dark:bg-gray-800">
        <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full px-4 md:w-1/2 ">
                    <div class="sticky top-0 z-50 overflow-hidden ">
                        <div class="relative mb-6 lg:mb-10 lg:h-2/4 ">
                            <img :src="'/storage/productos/'+ selectedImage" alt="Selected product image"
                                class="object-cover w-full lg:h-full ">
                        </div>
                        <div class="flex-wrap  md:flex">
                            <div v-for="(image, index) in product.product_image.split(',')" :key="index"
                                class="w-1/2 p-2 sm:w-1/4">
                                <a href="#"
                                    class="block border border-blue-300 dark:border-transparent dark:hover:border-blue-300 hover:border-blue-300">
                                    <img :src="'/storage/productos/'+ image.trim()" alt="Product image"
                                        @click="selectedImage = image.trim()" class="object-cover w-full lg:h-20">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-4 md:w-1/2 ">
                    <div class="lg:pl-20">
                        <div class="mb-8 ">
                            <span class="text-lg font-medium text-rose-500 dark:text-rose-200">New</span>
                            <h2 class="max-w-xl mt-2 mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl">
                                {{ product.name }}</h2>
                            <p class="max-w-md mb-8 text-gray-700 dark:text-gray-400">
                                {{ product.description }}
                            </p>
                            <p class="inline-block mb-8 text-4xl font-bold text-gray-700 dark:text-gray-400 ">
                                <span>${{ product.price }}</span>
                               
                            </p>
                            <h2 class="w-16 mr-6 text-xl font-bold dark:text-gray-400">Stock</h2>
                            <p class="text-green-600 dark:text-green-300 ">{{ product.stock }}</p>
                        </div>
                        <div class="w-32 mb-8 ">
                            <label for=""
                                class="w-full text-xl font-semibold text-gray-700 dark:text-gray-400">Quantity</label>
                            <div class="relative flex flex-row w-full h-10 mt-4 bg-transparent rounded-lg">
                                <button
                                    class="w-20 h-full text-gray-600 bg-gray-300 rounded-l outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-gray-400">
                                    <span class="m-auto text-2xl font-thin">-</span>
                                </button>
                                <input type="number"
                                    class="flex items-center w-full font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-300 outline-none dark:text-gray-400 dark:placeholder-gray-400 dark:bg-gray-900 focus:outline-none text-md hover:text-black"
                                    placeholder="1">
                                <button
                                    class="w-20 h-full text-gray-600 bg-gray-300 rounded-r outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-gray-400">
                                    <span class="m-auto text-2xl font-thin">+</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center -mx-4 ">
                            <div class="w-full px-4 mb-4 lg:w-1/2 lg:mb-0">
                                <button
                                    class="flex items-center justify-center w-full p-4 text-blue-500 border border-blue-500 rounded-md dark:text-gray-200 dark:border-blue-600 hover:bg-blue-600 hover:border-blue-600 hover:text-gray-100 dark:bg-blue-600 dark:hover:bg-blue-700 dark:hover:border-blue-700 dark:hover:text-gray-300">
                                    Add to Cart
                                </button>
                            </div>
                            <div class="w-full px-4 mb-4 lg:mb-0 lg:w-1/2">
                                <button
                                    class="flex items-center justify-center w-full p-4 text-blue-500 border border-blue-500 rounded-md dark:text-gray-200 dark:border-blue-600 hover:bg-blue-600 hover:border-blue-600 hover:text-gray-100 dark:bg-blue-600 dark:hover:bg-blue-700 dark:hover:border-blue-700 dark:hover:text-gray-300">
                                    Add to wishlist
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';

export default {
    props: ['id'],
    data() {
        return {
            selectedImage: '',
            product: {
                product_image: ''
            }
        };
    },
    mounted() {
        axios.get('/productos/' + this.id)
            .then(response => {
                this.product = response.data;
                console.log(this.product)
                if (this.product.product_image) {
                    this.selectedImage = this.product.product_image.split(',')[0].trim();
                }

            })
    },
  
};
</script>