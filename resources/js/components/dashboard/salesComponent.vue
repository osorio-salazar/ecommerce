<template>
    <div class="flex flex-col">
        <h2 class="text-2xl font-semibold mb-4">Historial de Ventas</h2>
        <div class="mb-4">
            <label for="search" class="sr-only">Buscar:</label>
            <input type="text" id="search" v-model="searchTerm" @input="updateSearch" placeholder="Buscar productos..."
                class="border border-gray-300 p-2 w-full" />
        </div>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                            <tr class="text-center">
                                <th scope="col" class="px-6 py-4">Productos</th>
                                <th scope="col" class="px-6 py-4">Cantidad</th>
                                <th scope="col" class="px-6 py-4">Precio</th>
                                <th scope="col" class="px-6 py-4">Fecha de Compra</th>
                                <th scope="col" class="px-6 py-4">Estado</th>
                                <th scope="col" class="px-6 py-4">User Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center border-b dark:border-neutral-500" v-for="purchase in purchases"
                                :key="purchase.id" v-show="purchase.isVisible">
                                <td>
                                    <div v-for="product in purchase.products" :key="product.id">
                                        <span class="font-semibold">{{ product.name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div v-for="product in purchase.products" :key="product.id">
                                        {{ product.cantidad }}
                                    </div>
                                </td>
                                <td>
                                    <div v-for="product in purchase.products" :key="product.id">
                                        ${{ product.price }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    {{ purchase.purchase_date }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    {{ purchase.status === 1 ? 'Pendiente' : 'Completado' }}
                                </td>

                                <td>
                                   {{ purchase.user_id }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            purchases: [],
            searchTerm: '',

        };
    },


    created() {
        this.shoppingProducts();
    },

    methods: {
        paymentSucces() {
            axios.get('/paymentSuccess')
                .then(response => {
                    console.log(this.response)
                })

        },

        fetchCart() {
            axios.get('/cart')
                .then(response => {
                    localStorage.setItem('cart', JSON.stringify(response.data));

                })
                .catch(error => {
                    console.error(error);
                });
        },


        shoppingProducts() {
            axios.get('/paymentTest')
                .then(response => {
                    this.purchases = response.data;
                    this.purchases.forEach((purchase) => {
                        purchase.isVisible = true; // Inicializa la propiedad isVisible
                    });


                })
                .catch(

            )
        },
        updateSearch() {
            const value = this.searchTerm.toLowerCase();

            this.purchases.forEach((purchase) => {
                const isVisible = purchase.products.some((product) =>
                    product.name.toLowerCase().includes(value)
                );

                purchase.isVisible = isVisible;
            });
        },


    },


}








</script>