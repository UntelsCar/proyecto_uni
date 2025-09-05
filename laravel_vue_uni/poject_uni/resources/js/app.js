import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import 'bootstrap/dist/css/bootstrap.min.css';  // Estilos de Bootstrap
import 'bootstrap/dist/js/bootstrap.bundle.min.js';  // Incluye Popper.js y la funcionalidad JavaScript de Bootstrap
import 'bootstrap';  // JavaScript de Bootstrap
import 'bootstrap-icons/font/bootstrap-icons.css';


//importacion de axios
import VueAxios from 'vue-axios';
import axios from 'axios';

//importacion de vue-router
import router from './routes';

const app = createApp(App);
app.use(router);
app.use(VueAxios, axios);
app.mount('#app');




