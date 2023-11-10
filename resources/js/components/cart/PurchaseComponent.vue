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
                                    <th class="text-left font-semibold">Product</th>
                                    <th class="text-left font-semibold">Price</th>
                                    <th class="text-left font-semibold">Quantity</th>
                                    <th class="text-left font-semibold">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product, index) in cart.products" :key="index">
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <img :src="'/storage/productos/' + product.product_image.split(',')[0].trim()"
                                                :alt="product.imageAlt" class="h-16 w-16 mr-4" />
                                            <span class="font-semibold text-2xl ml-5">{{ product.name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4">${{ product.price.toFixed(2) }}</td>
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <p>{{ product.cantidad }}</p>
                                        </div>
                                    </td>
                                    <td class="py-4">${{ (product.price * product.cantidad).toFixed(2) }}</td>
                                </tr>
                                <!-- More product rows -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="md:w-1/4">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold mb-4">Summary</h2>
                        <div class="flex justify-between mb-2">
                            <span>Subtotal</span>
                            <span>$19.99</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>Taxes</span>
                            <span>$1.99</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>Shipping</span>
                            <span>$0.00</span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Total</span>
                            <span class="font-semibold">$21.98</span>
                        </div>
                        <button class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            cart: null,
        };
    },
    created() {
        this.cart = JSON.parse(this.$route.query.cartData);
        console.log('Productos en el carrito:', this.cart.products);
    },
    methods: {
        realizarCompra() {
            // Lógica para realizar la compra
            console.log('Compra realizada');
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