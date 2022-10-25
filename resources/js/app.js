require("./bootstrap");

import { createApp } from "vue";
import App from "./components/App.vue";

import VueAxios from "vue-axios";

import { createRouter, createWebHistory } from "vue-router";
import routes from "./routes";
// import "./index.css";
import axios from "axios";

axios.defaults.baseURL = "http://dev.test.lh:8000/api/";

const app = createApp(App);

// app.use(routes);
const router = createRouter({
    history: createWebHistory(),
    routes: routes.routes,
});

app.use(router);
app.use(VueAxios, axios);

app.mount("#app");
