<template>
    <div style="padding: 40px;">
        <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Crear Producto</h1>

        <form method="POST" v-on:submit.prevent="saveProduct">
            <!-- token -->


            <label for="">Nombre</label> <br>
            <input style="border: 1px solid #000" type="text" id="name" v-model="name" name="name"
                placeholder="Nombre" required /> <br><br>

            <label for="">Descripción</label> <br>
            <input style="border: 1px solid #000" type="text" id="description" v-model="description"
                name="description" placeholder="Descripcion" required /> <br><br>

            <label for="">Precio</label> <br>
            <input style="border: 1px solid #000" type="text" id="price" v-model="price" name="price"
                placeholder="Precio" required /> <br><br>

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
            

        };
    },
    methods: {
        saveProduct() {
            axios.post('/productos',
                {
                    name: this.name,
                    description: this.description,
                    price: this.price,
                   

                }
            )
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                });
        }


    },
};
</script>