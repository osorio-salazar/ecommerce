<template>
    <div style="padding: 40px;">
        <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Editar Categoría</h1>

        <form @submit.prevent="updateCategoria" enctype="multipart/form-data">
            <label for="name">Nombre</label><br>
            <input required style="border: 1px solid #000" type="text" id="name" name="name" v-model="categoria.name"/><br /><br>

            <label for="description">Descripción</label><br>
            <input required style="border: 1px solid #000" type="text" id="description" name="description" v-model="categoria.description" /><br><br>

            <label for="category_image">Imagen de Categoría</label><br>
            <input type="file" id="category_image" name="category_image" accept="image/*" @change="onFileChange" /><br><br>

            <img :src="'/storage/' + categoria.category_image" alt="Categoría image"
                style="max-width: 200px; margin-right: 10px;"><br /><br>

            <button type="submit" style="background: rgb(97, 205, 97); padding: 8px;">Actualizar</button>
        </form>
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
                })
                .catch(error => {
                    console.log(error);
                });
        },
        onFileChange(event) {
            this.categoria.category_image = event.target.files[0];
        },
        updateCategoria() {
            const categoriaId = this.$route.params.id;

            const formData = new FormData();
            formData.append('name', this.categoria.name);
            formData.append('description', this.categoria.description);
            // formData.append('category_image', this.categoria.category_image);

            if (this.categoria.category_image) {
                formData.append('category_image', this.categoria.category_image);
            }

            axios.put(`/categorias/${categoriaId}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    // this.data = response.data;
                    alert('Categoría actualizada exitosamente');
                    this.$router.push('/admin/category/list');
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
};
</script>
