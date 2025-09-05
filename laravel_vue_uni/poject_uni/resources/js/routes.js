import { createRouter, createWebHistory } from 'vue-router';

//componentes para el personal administrativo

const inicioAdministrativo = () => import('./components/pers_administrativo/estudiante/Index.vue');
//Estudiantes
const listarEstudiante = () => import('./components/pers_administrativo/estudiante/ListarEstudiantes.vue');
const añadirEstudiante = () => import('./components/pers_administrativo/estudiante/CrearEstudiante.vue');
const editarEstudiante = () => import('./components/pers_administrativo/estudiante/EditarEstudiante.vue');
const mostrarEstudiante = () => import('./components/pers_administrativo/estudiante/MostrarEstudiante.vue');

//Estacionamiento
const listarRegistroEstacionamiento = () => import('./components/pers_administrativo/personal/estacionamiento/ListarRegistroEstacionamiento.vue');
const añadirRegistroEstacionamiento = () => import('./components/pers_administrativo/personal/estacionamiento/CrearRegistroEstacionamiento.vue');
const editarRegistroEstacionamiento = () => import('./components/pers_administrativo/personal/estacionamiento/EditarRegistroEstacionamiento.vue');
const mostrarRegistroEstacionamiento = () => import('./components/pers_administrativo/personal/estacionamiento/MostrarRegistroEstacionamiento.vue');

const routes = [
    //Personal administrativo
    {name: 'inicioAdministrativo', path: '/', component: inicioAdministrativo},
    //Estudiantes
    {name: 'listarEstudiante', path: '/estudiantes', component:listarEstudiante},
    {name: 'añadirEstudiante', path: '/estudiante', component:añadirEstudiante},
    {name: 'editarEstudiante', path: '/estudiante/:id', component:editarEstudiante},
    {name: 'mostrarEstudiante', path: '/estudiante/:id', component:mostrarEstudiante},

    //Porteria
    {name: 'listarRegistroEstacionamiento', path: '/registros', component:listarRegistroEstacionamiento},
    {name: 'añadirRegistroEstacionamiento', path: '/registro', component:añadirRegistroEstacionamiento},
    {name: 'editarRegistroEstacionamiento', path: '/registro/:id', component:editarRegistroEstacionamiento},
    {name: 'mostrarRegistroEstacionamiento', path: '/registro/:id', component:mostrarRegistroEstacionamiento},

];

export default createRouter({
    history: createWebHistory(),
    routes
});