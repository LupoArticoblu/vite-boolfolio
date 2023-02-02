import { createApp } from "vue";

import { router } from "./router";
//prendo il componente
import  App  from "./app.vue";
//creo app e lo monto su id app
createApp(App).use(router).mount('#app')