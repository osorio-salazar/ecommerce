<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form v-on:submit.prevent="saveProduct">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Nombre del producto
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                        v-model="name" name="name" placeholder="Nombre" required>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Categoria del producto
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <select id="category" v-model="category" name="category" required
                                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                        <option value="" disabled>Selecciona una categoria</option>
                                        <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{
                                            categoria.name }} </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Precio del producto
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="number"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                        v-model="price" name="price" placeholder="Precio" required>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Cantidad del producto
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="number"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                        id="stock" v-model="stock" name="stock" placeholder="Cantidad" required>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="about" class="block text-sm font-medium text-gray-700">
                                Descripcion:
                            </label>
                            <div class="mt-1">
                                <textarea rows="3"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                                    id="description" v-model="description" name="description"></textarea>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                Breve descripcion de tu producto.
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Cover photo
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <div class="flex flex-wrap">
                                        <img v-for="(image, index) in uploadedImages" :src="image" :key="index"
                                            class="h-48 w-48 object-cover m-2">
                                    </div>
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="True">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="images"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Agrega una imagen</span>
                                            <input id="images" type="file" class="sr-only" @change="handleImageUpload"
                                                name="images[]" multiple>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF up to 10MB
                                    </p>
                                    <button type="button" class="mt-2 text-sm text-red-600 hover:text-red-900"
                                        @click="deleteImage">
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

import axios from 'axios'

export default {
    data() {
        return {
            name: '',
            description: '',
            price: '',
            imagesP: [],
            category: '',
            categorias: [],
            stock: '',
            uploadedImages: [],
        };
    },

    created() {
        this.loadCategorias();

    },
    methods: {
        handleImageUpload(event) {
            this.imagesP = Array.from(event.target.files);
            for (let i = 0; i < this.imagesP.length; i++) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.uploadedImages.push(e.target.result);
                };
                reader.readAsDataURL(this.imagesP[i]);
            }
        },

        deleteImage() {

            this.uploadedImages.pop();
            this.imagesP.pop();

        },
        loadCategorias() {
            axios.get('/categorias')
                .then(response => {
                    this.categorias = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },


        saveProduct() {
            const formData = new FormData();
            formData.append('name', this.name);
            formData.append('description', this.description);
            formData.append('price', this.price);
            formData.append('stock', this.stock);
            formData.append('category_id', this.category)

            for (let i = 0; i < this.imagesP.length; i++) {
                formData.append('images[]', this.imagesP[i]);
            }
            console.log(this.imagesP);
            axios.post('/productos', formData)
                .then(response => {
                    console.log(response.data.message);
                    alert('producto creado con exito')
                    this.$router.push('/dashboard/product/list');
                })


                .catch(error => {
                    console.error(error);
                });
        },
        // ...
    },

};
</script>