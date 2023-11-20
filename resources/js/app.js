import { createApp } from "vue";
import App from '../js/components/App.vue'
import router from '../js/router.js'
import '../css/app.css'
import navComponent from '../js/components/admin/navDashboard.vue'
import axios from "axios";

const app = createApp(App);

app.use(router);
app.component('nav-component', navComponent)
app.mount("#app");

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': window.csrf_token
};
