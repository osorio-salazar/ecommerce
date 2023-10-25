<template>
  
  <Navbar/>

  <router-view></router-view> 
   <div> 
  <Footer/>   
  </div>
</template>
  
  <script>
    import Navbar from '../components/Navbar.vue'
    import Footer from './Footer.vue';

    export default {
      name: 'App',
      components:{
        Navbar,
        Footer
      }
    }
  </script>
  
  
  <style>
  
  </style>
  