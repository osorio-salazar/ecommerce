<template>

  <header>
    <Navbar v-if="showNavbar"></Navbar>
  </header>
 

  <body>
    <router-view></router-view>
  </body>



  <footer>
    <Footer v-if="showFooter"></Footer>
  </footer>
  

</template>
  
<script>
import Navbar from './Navbar.vue';
import Footer from './Footer.vue';


export default {
  name: 'App',
  components: {
    Navbar,
    Footer




  },
  data() {
    return {
      showNavbar: true,
      showFooter: true,
    };
  },
  watch: {
    $route(to) {
      if (to.path === '/login' || to.path === '/register' || to.name === 'productEdit') {
        this.showNavbar = false;
        this.showFooter = false;
      } else {
        this.showNavbar = true;
        this.showFooter = true;
      }
    }
  }

}
</script>
  
  
<style></style>
  