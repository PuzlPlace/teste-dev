// main.js

import { createApp } from 'vue';
import App from './App.vue';
import store from './store';
import router from './router';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

const app = createApp(App);

app.use(store);
app.use(router);


app.mount('#app');

