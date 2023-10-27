<template>
    <div style="padding: 40px;">
        <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Editar Producto</h1>

        <form @submit.prevent="updateProduct">
            <label for="name">Nombre</label><br>
            <input style="border: 1px solid #000" type="text" id="name" v-model="product.name" name="name" required /><br /><br>

            <label for="description">Descripción</label><br>
            <input style="border: 1px solid #000" type="text" id="description" v-model="product.description" name="description" required /><br /><br>

            <label for="price">Precio</label><br>
            <input style="border: 1px solid #000" type="text" id="price" v-model="product.price" name="price" required /><br /><br>

            <button type="submit" style="background: rgb(97, 205, 97); padding: 8px;">Actualizar</button>
        </form>
    </div>
</template>
  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            product: {
                name: '',
                description: '',
                price: '',
            },
        };
    },
    created() {
        this.fetchProduct();
    },
    methods: {
        fetchProduct() {
            const productId = this.$route.params.id; // Obtener el ID del producto desde la ruta
            axios.get(`/productos/${productId}`)
                .then(response => {
                    this.product = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        updateProduct() {
            const productId = this.$route.params.id; // Obtener el ID del producto desde la ruta
            axios.put(`/productos/${productId}`, this.product)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
};
</script>
  