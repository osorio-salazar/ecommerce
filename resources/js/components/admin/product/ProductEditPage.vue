<template>
    <div style="padding: 40px;">
        <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Editar Producto</h1>

        <form @submit.prevent="updateProduct">
            <label for="name">Nombre</label><br>
            <input style="border: 1px solid #000" type="text" id="name" name="name" required
                v-model="producto.name" /><br /><br>

            <label for="description">Descripción</label><br>
            <input style="border: 1px solid #000" type="text" id="description" name="description" required
                v-model="producto.description" /><br /><br>


            <div>
                <label for="images">Imágenes</label><br>
                <input type="file" id="images" name="images[]" multiple accept="image/*" @change="onFileChange" /><br /><br>

                <div>
                    <img v-for="(product_image, index) in producto.product_image.split(',')" :key="index"
                        :src="'/storage/' + product_image" alt="product image"
                        style="max-width: 200px; margin-right: 10px;">
                    <a @click="deleteImage(index)">Eliminar</a>
                </div>
            </div>



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
            producto: {}
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
                    console.log(this.producto.product_image)
                })
                .catch(error => {
                    console.log(error);
                });
        },
        deleteImage(index) {
            this.producto.product_image = this.producto.product_image.split(',');
            this.producto.product_image.splice(index, 1);
            this.producto.product_image = this.producto.product_image.join(',');

          
             axios.delete('/storage', { image: this.producto.product_image[index] })
                 .then(response => {

                     console.log()
                 })
                 .catch(error => {
                    
             });
        },

        updateProduct() {
            const productId = this.$route.params.id;


            const data = {
                name: this.producto.name,
                description: this.producto.description,
                price: this.producto.price,
                stock: this.producto.stock,
            };

            axios.put(`/productos/${productId}`, data)
                .then(response => {
                    this.data = response.data;
                    console.log(this.producto)
                    alert('Producto actualizado exitosamente');
                    this.$router.push('/admin/product/list');
                })
                .catch(error => {
                    console.log(error);
                });
        }


    },



};
</script>
