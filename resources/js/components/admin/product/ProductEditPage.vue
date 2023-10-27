<template>
    <div style="padding: 40px;">
        <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Editar Producto</h1>

        <form @submit.prevent="">
            <label for="name">Nombre</label><br>
            <input style="border: 1px solid #000" type="text" id="name" name="name" required
                v-model="producto.name" /><br /><br>

            <label for="description">Descripción</label><br>
            <input style="border: 1px solid #000" type="text" id="description" name="description" required
                v-model="producto.description" /><br /><br>

            <label for="price">Precio</label><br>
            <input style="border: 1px solid #000" type="text" id="price" name="price" required
                v-model="producto.price" /><br /><br>

            <label for="price">Stock</label><br>
            <input style="border: 1px solid #000" type="text" id="stock" name="stock" required
                v-model="producto.stock" /><br /><br>

            <button type="submit" style="background: rgb(97, 205, 97); padding: 8px;">Actualizar</button>
        </form>
    </div>
</template>
  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            producto: {
                name: '',
                description: '',
                price: '',
                stock: ''
            }
        };
    },
    created() {
        this.getProduct();
    },
    methods: {
        getProduct() {
            const productId = this.$route.params.id;
            axios.get(`/productos/${productId}/edit`)
                .then(response => {
                    this.producto = response.data;
                    console.log(this.producto);
                })
                .catch(error => {
                    console.log(error);
                });
        },

        updateProduct() {



        }


    },



};
</script>
