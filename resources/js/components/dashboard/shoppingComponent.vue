<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4">Productos</th>
                                <th scope="col" class="px-6 py-4">Precio</th>
                                <th scope="col" class="px-6 py-4">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:border-neutral-500" v-for="purchases in purchases " :key="purchases.id">

                                <td>
                                    {{ purchases }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium">
                                    <!-- <div v-for="product in purchase.products" :key="product.id">
                                        {{ purchase.product }}
                                    </div> -->
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <!-- <div v-for="product in purchase.products" :key="product.id">
                                        {{ product.price }}
                                    </div> -->
                                </td>
                                <td class="whitespace-nowrap px-6 py-4"></td>
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

        };
    },


    created() {
        this.cartDelete();
        this.shoppingProducts();


    },

    methods: {
        paymentSucces() {
            axios.get('/paymentSuccess')
                .then(response => {
                    console.log()
                })

        },

        cartDelete(id) {
            if (this.$route.query.success !== undefined) {
                this.paymentSucces();
                console.log('dalepapa')
            }
            else {
                console.log('no se pudo pa')
            }
        },


        shoppingProducts() {
            axios.get('/paymentTest')
                .then(response => {
                    this.purchases = response.data
                    console.log(this.purchases.id)

                })
                .catch(

            )




        }











    },


}








</script>