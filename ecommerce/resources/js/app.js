

import { createApp } from "vue";
import App from '../js/components/App.vue'
import router from '../js/router.js'
import '../css/app.css'





const app = createApp(App);

app.use(router);


app.mount("#app");