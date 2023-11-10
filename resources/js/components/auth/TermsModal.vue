<template>
    <div class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-4 rounded-md mx-2 sm:mx-4 md:mx-8 lg:mx-16 xl:mx-32 max-w-lg">
            <!-- Contenido de tus términos y condiciones -->
            <h2 class="text-2xl font-bold mb-4">Términos y Condiciones.</h2>

            <p class="text-lg">
                Bienvenid@ a nuestro ecommerce. Al acceder y realizar compras en nuestro sitio, aceptas los siguientes términos y condiciones.
            </p>

            <h4 class="text-lg font-semibold mt-4">1. Realización de Pedidos</h4>
            <p class="text-lg">
                Al realizar un pedido, te comprometes a proporcionar información precisa y completa. Nos reservamos el derecho de cancelar o rechazar cualquier pedido por diversas razones, incluyendo la disponibilidad de productos y errores en la información del pedido.
            </p>

            <h4 class="text-lg font-semibold mt-4">2. Pago y Facturación</h4>
            <p class="text-lg">
                Los pagos se procesarán a través de métodos seguros. Asegúrate de proporcionar información de pago precisa. Nos reservamos el derecho de cambiar precios y especificaciones de productos sin previo aviso.
            </p>

            <h4 class="text-lg font-semibold mt-4">3. Envío y Entrega</h4>
            <p class="text-lg">
                Nos esforzamos por realizar envíos oportunos. Sin embargo, los plazos de entrega son estimados y pueden variar. No nos hacemos responsables de retrasos causados por eventos fuera de nuestro control.
            </p>

            <button @click="closeModal" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md">Cerrar</button>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        closeModal() {
            this.$emit("close");
        },
    },
};
</script>