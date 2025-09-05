<template>
    <h1 class="text-center">Lista de registros</h1>

    <div class="container">

        <!-- cabecera -->
        <div class="cabecera">
            <button type="button" class="btn btn-outline-primary">Button</button>
        </div>

        <!-- tabla de registros -->
        <div class="tablaRegistros">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Codigo de estudiante</th>
                        <th scope="col">fecha de ingreso</th>
                        <th scope="col">tipo de vehiculo</th>
                        <th scope="cool">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="registro in registros" :key="registro.rgEst_id">
                        <th scope="row">{{ registro.estudiante_id }}</th>
                        <td>{{ registro.fecha_ingreso }}</td>
                        <td>{{ registro.tipo_vehiculo }}</td>
                        <td>
                            <!-- Botón para mostrar -->
                            <router-link :to="{name:'mostrarRegistroEstacionamiento', params:{id: registro.rgEst_id}}" class="btn btn-info btn-sm me-2 rounded-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                            </svg>
                            </router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
          </div>
          
    </div>
</template>

<script>
export default{
    name:"listar-registroEstacionamiento",
    data(){
        return{
            registros:{},
        }
    },
    mounted(){
        this.listarRegistrosEstacionamiento();
    },
    methods:{

        async listarRegistrosEstacionamiento(){
            try {
                const response = await this.axios.get('/api/estacionamiento');
                console.log(response.data.registros)
                this.registros = response.data.registros
                
            } catch (error) {
                
            }
        }
    }

}
</script>

<style scoped>
.container {
    width: 100%;
    height: 100vh;

}
</style>

