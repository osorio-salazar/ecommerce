<template>
    <div style="padding: 40px;">
        <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Crear Producto</h1>

        <form @submit.prevent="submitForm">
            <!-- token -->
            

            <label for="">Nombre</label> <br>
            <input style="border: 1px solid #000" type="text" id="name" v-model="formData.name" name="name" placeholder="Nombre" required/> <br><br>

            <label for="">Descripción</label> <br>
            <input style="border: 1px solid #000" type="text" id="description" v-model="formData.description" name="description" placeholder="Descripcion" required/> <br><br>

            <label for="">Precio</label> <br>
            <input style="border: 1px solid #000" type="text" id="price" v-model="formData.price" name="price" placeholder="Precio" required/> <br><br>

            <label for="">Imagen del Producto</label> <br>
            <input style="border: 1px solid #000" type="file" id="images_product" @change="handleFileUpload" accept="image/*" name="images_product" required/> <br><br>

            <button type="submit" style="background: rgb(97, 205, 97); padding: 8px;">Guardar</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                formData: {
                    name: '',
                    description: '',
                    price: '',
                    images_product: null,
                },
            };
        },
        methods: {
            async submitForm() {
                try {
                    const formData = new FormData();
                    formData.append('name', this.formData.name);
                    formData.append('description', this.formData.description);
                    formData.append('price', this.formData.price);
                    formData.append('images_product', this.formData.image);

                    const response = await fetch('/productos', {
                        method: 'POST',
                        body: formData,
                    });

                    if (response.ok) {
                        const data = await response.json();

                        // Redirige a la lista de productos después de guardar
                        this.$router.push('/admin/product/list'); // Reemplaza '/ruta-de-lista-de-productos' con la ruta correcta
                    } else {
                        console.error('Error:', response.statusText);
                    }
                } catch (error) {
                    console.error('Network error:', error);
                }                
            },
            handleFileUpload(event) {
                this.formData.image = event.target.files[0];
            },
        },
    };
</script>