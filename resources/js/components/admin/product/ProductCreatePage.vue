<template>
    <div style="padding: 40px;">
        <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Crear Producto</h1>

        <form method="POST" v-on:submit.prevent="saveProduct">
            <!-- token -->
            <label for="">Nombre</label> <br>
            <input style="border: 1px solid #000" type="text" id="name" v-model="name" name="name" placeholder="Nombre"
                required /> <br><br>

            <label for="">Descripción</label> <br>
            <input style="border: 1px solid #000" type="text" id="description" v-model="description" name="description"
                placeholder="Descripcion" required /> <br><br>

            <label for="">Cantidad</label> <br>
            <input style="border: 1px solid #000" type="number" id="stock" v-model="stock" name="stock"
                placeholder="Cantidad" required /> <br><br>

            <label for="">Precio</label> <br>
            <input style="border: 1px solid #000" type="text" id="price" v-model="price" name="price" placeholder="Precio"
                required /> <br><br>

            <label for="">Imagenes:</label> <br>
            <input type="file" @change="handleImageUpload" multiple style="border: 1px solid #000" id="images" required
                name="images[]" />
            <br><br>

            <button type="submit" style="background: rgb(97, 205, 97); padding: 8px;">Guardar</button>
        </form>
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
            stock: '',
        };
    },
    methods: {

        handleImageUpload(event) {
            this.imagesP = event.target.files;
        },


        saveProduct() {
            const formData = new FormData();
            formData.append('name', this.name);
            formData.append('description', this.description);
            formData.append('price', this.price);
            formData.append('stock', this.stock);

            for (let i = 0; i < this.imagesP.length; i++) {
                // Agregar cada imagen al objeto FormData
                formData.append('images[]', this.imagesP[i]);
            }

            console.log(this.imagesP);




            axios.post('/productos', formData)
                .then(response => {
                    console.log(response.data.message);
                    this.name = '';
                    this.description = '';
                    this.price = '';
                    this.stock = '';
                    this.imagesP = []; // Limpiar el arreglo de imágenes
                })
                .catch(error => {
                    console.error(error);
                });
        },
        // ...
    },

};
</script>