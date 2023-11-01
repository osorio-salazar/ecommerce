import { createApp } from "vue";
import App from '../js/components/App.vue'
import router from '../js/router.js'
import '../css/app.css'
import navComponent from '../js/components/admin/navDashboard.vue'

const app = createApp(App);

// Vue.component('product-list-page', require('./components/admin/product/ProductListPage.vue').default);
// Vue.component('product-create-page', require('./components/admin/product/ProductCreatePage.vue').default);
// Vue.component('product-edit-page', require('./components/admin/product/ProductEditPage.vue').default);

app.use(router);
app.component('nav-component', navComponent)
app.mount("#app");

