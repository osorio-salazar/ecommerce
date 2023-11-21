<template>
    <div class="bg-gray-100 h-screen py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-semibold mb-4">Productos en el carrito</h1>
            <div class="flex flex-col md:flex-row gap-4">
                <div class="md:w-3/4">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="text-left font-semibold">Productos</th>
                                    <th class="text-left font-semibold">Precio</th>
                                    <th class="text-left font-semibold">Cantidad</th>
                                    <th class="text-left font-semibold">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in cart" :key="product.id">
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <img :src="'/storage/productos/' + product.product_image.split(',')[0].trim()"
                                                class="h-16 w-16 mr-4" />
                                            <span class="font-semibold text-2xl ml-5">{{ product.name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4">${{ product.price }}</td>
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <p>{{ product.cantidad }}</p>
                                        </div>
                                    </td>
                                    <td class="py-4">${{ (product.price * product.cantidad) }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="md:w-1/4">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold mb-4">Summary</h2>
                        <div class="flex justify-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ subtotal }}</span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Total</span>
                            <span class="font-semibold">${{ subtotal }}</span>
                        </div>



                        <div id="cho-container"></div>
                        <button class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Checkout</button>





                        <hr class="my-2">

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

  
<script>

import axios, { Axios } from 'axios';
import { loadMercadoPago } from "@mercadopago/sdk-js";


export default {

    data() {
        return {
            cart: [],

        };
    },
    async created() {
        this.cart = JSON.parse(localStorage.getItem('cart')) || [];
        console.log('Productos en el carrito:', this.cart);
    },


    computed: {
        subtotal() {
            return this.cart.reduce((total, product) => {
                return total + (product.price * product.cantidad);
            }, 0);
        }
    },
    mounted() {
        this.userAuth();
    },


    methods: {
        async realizarCompra() {
            const container = document.getElementById('cho-container');

            while (container.firstChild) {
                container.removeChild(container.firstChild);
            }
            await loadMercadoPago();
            const mp = new window.MercadoPago("TEST-dbff2fdb-8932-4efa-9fd3-0f10db54ce4a", {
                locale: "es-CO",
            })

            const response = await axios.get('/createPayment');


            const preferenceId = response.data;


            mp.bricks().create("wallet", "cho-container", {
                initialization: {
                    preferenceId: preferenceId,
                    redirectMode: "modal",
                },
            })

        },

        getCartDataBase() {

        },

        userAuth() {
            axios.get('/getAuth')
                .then(response => {
                    this.user = response.data;
                    if (this.user) {
                        this.realizarCompra();
                    }

                })
        },

    },
};
</script>


<style scoped>
.purchase-container {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.purchase-title {
    font-size: 24px;
    margin-bottom: 20px;
}

.card {
    display: flex;
    border: 1px solid #ccc;
    border-radius: 8px;
    margin-bottom: 15px;
}

.card-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px 0 0 8px;
}

.card-info {
    padding: 10px;
}

.purchase-button {
    background-color: #4caf50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}
</style>