<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form v-on:submit.prevent="guardarCategoria">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="company_website" class="block text-sm font-medium text-gray-700">
                                    Nombre de la categoria
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" name="company_website" id="company_website"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                        v-model="categoria.name" required>
                                </div>
                            </div>
                        </div>


                        <div>
                            <label for="about" class="block text-sm font-medium text-gray-700">
                                Descripcion:
                            </label>
                            <div class="mt-1">
                                <textarea id="about" name="about" rows="3"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                                    v-model="categoria.description"></textarea>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                Breve descripcion de tu categoria.
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Cover photo
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <img v-if="categoria.previewImage" :src="categoria.previewImage"
                                        class="mx-auto h-48 w-48 rounded-md object-cover" />
                                    <svg v-else class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="True">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="category_image"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Agrega una imagen</span>
                                            <input type="file" class="sr-only" id="category_image" name="category_image"
                                                @change="onFileChange">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF up to 10MB
                                    </p>
                                    <button v-if="categoria.previewImage" type="button"
                                        class="mt-2 text-sm text-red-600 hover:text-red-900" @click="eliminarImagen">
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
            categoria: {
                name: '',
                description: '',
                category_image: null,
                previewImage: null,
            },
        };
    },
    methods: {
        guardarCategoria() {

            let formData = new FormData();
            formData.append('name', this.categoria.name);
            formData.append('description', this.categoria.description);
            formData.append('category_image', this.categoria.category_image);


            console.log(formData.get('category_image'));
            axios.post('/categorias', formData)
                .then(response => {
                    console.log(response.data);
                    alert('categoria creada con exito')
                    this.$router.push('/dashboard/category/list');
                })
                .catch(error => {
                    console.error(error);
                });
        },
        onFileChange(event) {
            this.categoria.category_image = event.target.files[0];
            this.categoria.previewImage = URL.createObjectURL(event.target.files[0]);
        },
        eliminarImagen() {
            this.categoria.category_image = null;
            this.categoria.previewImage = null;
        },
    },
};
</script>
  