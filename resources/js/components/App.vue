<template>
  <div>
    <header>
      <Navbar v-if="showNavbar"></Navbar>
    </header>
    <router-view></router-view>
    <footer>
      <Footer v-if="showFooter"></Footer>
    </footer>
  </div>
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
      if (to.path === '/login' || to.path === '/register' || to.name === 'productEdit' || to.name === 'dashboard' || to.path.startsWith('/dashboard')) {
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

