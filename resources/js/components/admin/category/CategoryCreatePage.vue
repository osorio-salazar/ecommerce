<template>
    <div style="padding: 40px;">
        <h2 class="text-2xl font-bold text-gray-900">Crear Nueva Categoría</h2>
        <form v-on:submit.prevent="guardarCategoria">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" v-model="categoria.name" class="form-control" required>
            </div><br>

            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea id="description" name="description" v-model="categoria.description" class="form-control" required></textarea>
            </div><br>

            <div class="form-group">
                <label for="category_image">Imagen:</label>
                <input type="file" id="category_image" name="category_image" @change="onFileChange" class="form-control-file">
            </div><br>

            <button type="submit" style="background: #176924; color: #fff; padding: 8px;">Guardar</button>
        </form>
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
            },
        };
    },
    methods: {
        guardarCategoria() {
            let formData = new FormData();
            formData.append('name', this.categoria.name);
            formData.append('description', this.categoria.description);
            formData.append('category_image', this.categoria.category_image);

            axios.post('/categorias', formData)
                .then(response => {
                    console.log(response.data);
                    // Puedes redirigir a otra página o realizar otras acciones después de crear la categoría
                })
                .catch(error => {
                    console.error(error);
                });
        },
        onFileChange(event) {
            this.categoria.category_image = event.target.files[0];
        },
    },
};
</script>
  