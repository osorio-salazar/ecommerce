<template>
    <div class="mt-0 md:grid md:grid-cols-3 md:gap-6">

        <div class="mt-5 md:mt-0 md:col-span-2">
            <form v-on:submit.prevent="updateProduct">
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
                                        id="name" name="name" required v-model="producto.name">
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
                                        id="price" name="price" required v-model="producto.price">
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
                                        id="stock" name="stock" required v-model="producto.stock">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Descripcion:
                            </label>
                            <div class="mt-1">
                                <textarea rows="3"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                                    type="text" id="description" name="description" required
                                    v-model="producto.description"></textarea>
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
                                        <!-- <img v-for="(product_image, index) in existingImages" :key="'existing-' + index"
                                            :src="'/storage/productos/' + product_image" alt="product image"
                                            class="h-48 w-48 object-cover m-2"> -->

                                        <div v-for="(image, index) in previewImages" :key="index">
                                            <img :src="image" class="h-48 w-48 object-cover m-2">
                                            <button type="button" @click="deleteNewImage(index)"
                                                class="mt-2 text-sm text-red-600 hover:text-red-900">Eliminar</button>
                                        </div>
                                        <div v-for="(image, index) in existingImages" :key="index">
                                            <img :src="'/storage/productos/' + image" class="h-48 w-48 object-cover m-2">
                                            <button type="button" @click="deleteExistingImage(index)"
                                                class="mt-2 text-sm text-red-600 hover:text-red-900">Eliminar</button>
                                        </div>



                                    </div>

                                    <div class="flex text-sm text-gray-600">
                                        <label for="images"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Agrega una imagen</span>
                                            <input id="images" type="file" class="sr-only" @change="handleImageUpload"
                                                multiple>
                                        </label>

                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF up to 10MB
                                    </p>

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
import axios from 'axios';

export default {
    data() {
        return {
            producto: {},
            uploadedImages: [],
            category: '',
            categorias: [],
            newImages: [],
            previewImages: [],
        };
    },


    computed: {
        existingImages() {
            // Asegúrate de que producto.product_image es un array
            if (typeof this.producto.product_image === 'string') {
                return this.producto.product_image.split(',');
            } else if (Array.isArray(this.producto.product_image)) {
                return this.producto.product_image;
            } else {
                return [];
            }
        },

    },
    created() {
        this.getProduct();
        this.loadCategorias();

    },
    methods: {
        getProduct() {
            const productId = this.$route.params.id;
            axios.get(`/productos/${productId}/edit`)
                .then(response => {
                    this.producto = response.data;
                    this.category = this.producto.category_id;
                    if (typeof this.producto.product_image === 'string') {
                        this.producto.product_image = this.producto.product_image.split(',');
                    } else if (!Array.isArray(this.producto.product_image)) {
                        this.producto.product_image = [];
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        loadCategorias() {
            axios.get('/categorias')
                .then(response => {
                    this.categorias = response.data;
                    console.log(this.categorias)
                })
                .catch(error => {
                    console.error(error);
                });
        },
        handleImageUpload(event) {
            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                this.newImages.push(files[i]);
                this.previewImages.push(URL.createObjectURL(files[i]));

            }
        },
        deleteExistingImage(index) {
            this.producto.product_image.splice(index, 1);
        },
        deleteNewImage(index) {
            this.newImages.splice(index, 1);
            this.previewImages.splice(index, 1);
        },
        updateProduct() {
            const productId = this.$route.params.id;
            const formData = new FormData();


            formData.append("_method", "PUT")
            formData.append('name', this.producto.name);
            formData.append('description', this.producto.description);
            formData.append('price', this.producto.price);
            formData.append('stock', this.producto.stock);
            formData.append('category_id', this.category)


            for (let i = 0; i < this.existingImages.length; i++) {
                formData.append('existing_images[]', this.existingImages[i]);
            }
            for (let i = 0; i < this.newImages.length; i++) {
                formData.append('new_images[]', this.newImages[i]);
            }

            axios.post(`/productos/${productId}`, formData)
                .then(response => {
                    this.data = response.data;
                    console.log(this.producto)
                    alert('Producto actualizado exitosamente');
                    this.$router.push('/dashboard/product/list');
                })
                .catch(error => {
                    console.log(error);
                });
        },



    },



};
</script>
