<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Lista de Categorías</h1>
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4">Nombre</th>
                                <th scope="col" class="px-6 py-4">Descripción</th>
                                <th scope="col" class="px-6 py-4">Imagen</th>
                                <th scope="col" class="px-6 py-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:border-neutral-500" v-for="categoria in categorias" :key="categoria.id">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ categoria.name }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ categoria.description }}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <img :src="'/storage/' + categoria.category_image" alt="Imagen de la categoría"
                                        class="w-20 h-20">
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <router-link :to="{ name: 'categoriaEdit', params: { id: categoria.id } }"
                                        class="bg-emerald-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1">Editar
                                    </router-link>
                                    <button @click="eliminarCategoria(categoria.id)"
                                        class="bg-red-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <router-link :to="{ path: '/dashboard/category/create' }"
                class="bg-blue-600 text-white border-e px-3 py-2 rounded-lg p-2 mx-1">Crear Categoria</router-link>
        </div>
    </div>
</template>
  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            categorias: [],
        };
    },
    created() {
        this.fetchCategorias();
    },
    methods: {
        fetchCategorias() {
            axios.get('/categorias')
                .then(response => {
                    this.categorias = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        eliminarCategoria(id) {
            if (confirm('¿Estás seguro de eliminar esta categoría?')) {
                axios.delete(`/categorias/${id}`)
                    .then(response => {
                        this.fetchCategorias(); // Actualizar la lista de categorías después de la eliminación
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        },
    },
};
</script> 