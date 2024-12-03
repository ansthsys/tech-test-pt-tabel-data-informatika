import "./assets/main.css";
import "primeicons/primeicons.css";
import "@steveyuowo/vue-hot-toast/vue-hot-toast.css";

import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./router";

const app = createApp(App);

app.use(createPinia());
app.use(router);

app.mount("#app");
