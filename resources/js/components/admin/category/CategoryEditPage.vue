<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form @submit.prevent="updateCategoria">
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
                                        class="mx-auto h-96 w-96 rounded-md object-cover" />
                                    <img v-else :src="'/storage/' + categoria.category_image" alt="Categoría image"
                                        class="mx-auto h-96 w-96 rounded-md object-cover" />

                                    <div class="flex text-sm text-gray-600">
                                        <label for="category_image"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload a file</span>
                                            <input type="file" class="sr-only" id="category_image" name="category_image"
                                                @change="onFileChange">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
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
                            Actualizar
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
            categoria: {
                name: '',
                description: '',
                previewImage: null,
                category_image: null,

            },
        };
    },
    created() {
        this.getCategoria();
    },
    methods: {
        getCategoria() {
            const categoriaId = this.$route.params.id;
            axios.get(`/categorias/${categoriaId}/edit`)
                .then(response => {
                    this.categoria = response.data;
                    // console.log(this.categoria);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        onFileChange(event) {
            this.categoria.category_image = event.target.files[0];
            this.categoria.previewImage = URL.createObjectURL(event.target.files[0]);
            // console.log(this.categoria.category_image)
        },
        updateCategoria() {
            const categoriaId = this.$route.params.id;

            console.log(this.categoria.description)
            const formData = new FormData();

            formData.append("_method", "PUT")
            formData.append('name', this.categoria.name);
            formData.append('description', this.categoria.description);
            formData.append('category_image', this.categoria.category_image);


            // console.log(formData);

            axios.post(`/categorias/${categoriaId}`, formData, {
            })
                .then(response => {
                    console.log(formData.category_image)
                    alert('Categoría actualizada exitosamente');
                    this.$router.push('/dashboard/category/list');
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
};
</script>
