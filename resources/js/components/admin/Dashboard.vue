<template>
  <div class="dashboard-container admin-view">
    <navDashboard class="sidebar"></navDashboard>
    <section class="main-content">

      <router-view>

      </router-view>

    </section>
  </div>
</template>

<script>
import axios from 'axios';
import navDashboard from './navDashboard.vue';
import ProductList from './product/ProductListPage.vue'

export default {
  components: {
    navDashboard,
    ProductList
  },


  
}
</script>

<style>
.dashboard-container {
  width: 100%;
  /* Ancho completo del contenedor */
  display: flex;
  /* Mostrar los elementos en línea */
}

.admin-view {
  margin-left: 0;
  /* Margen izquierdo para alinear a la izquierda */
}

.sidebar {
  width: 15%;
  /* Ancho de la barra lateral */
  background-color: #f5f5f5;
  /* Color de fondo de la barra lateral */
}

.main-content {
  width: 85%;
  /* Ancho del contenido principal */
  padding: 2rem;
  /* Espacio interno del contenido principal */
}
</style>
