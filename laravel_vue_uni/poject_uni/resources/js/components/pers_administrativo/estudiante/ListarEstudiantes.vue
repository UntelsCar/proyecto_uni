<template>
      <h1 class="text-center mb-4" style="color: black;">Lista de Estudiantes</h1>
    <!-- Tabla de estudiantes -->
    <div class="container">

      <!-- Cabecera -->
      <div class="position-relative py-3 ">
        <!-- Botón para agregar estudiante -->
      <router-link :to="{name:'añadirEstudiante'}" class="btn btn-primary d-inline-flex align-items-center rounded-pill ">
          <!-- SVG icon -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus me-2" viewBox="0 0 16 16">
            <path d="M8  15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
          </svg> 
          Agregar Estudiante
      </router-link>
      </div>

      <table class="table table-bordered table-striped">
        <thead class="table-head" >
          <tr>
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="estudiante in estudiantes" :key="estudiante.estudiante_id">
            <th scope="row">{{ estudiante.codigo }}</th>
            <td>{{ estudiante.nombres }} {{ estudiante.apellidos }}</td>
            <td>
              <!-- Sección de acciones -->
              <div class="align-items-center">
                <!-- Botón para eliminar -->
                <button @click="EliminarEstudiante(estudiante.estudiante_id)" class="btn btn-warning btn-sm me-2 rounded-circle">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                  </svg>
                </button>

                <!-- Botón para mostrar -->
                <router-link :to="{name:'mostrarEstudiante', params:{id: estudiante.estudiante_id}}" class="btn btn-info btn-sm me-2 rounded-circle">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                </svg>
                </router-link>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
    <!-- End tabla de estudiantes -->


</template>

<script>

export default{
  name:"lista-estudiantes",
  data(){
    return {
      estudiantes: [],
    };
  },
  mounted(){
  this.MostrarAlumnos();
  },
  methods:{
    // Funcuon para listar estudiantes
    async MostrarAlumnos(){
      try {
        const response = await this.axios.get('/api/estudiantes');
        this.estudiantes = response.data;
        // console.log(this.estudiantes);
        
      } catch (error) {
        console.error("Error al obtener los blogs:", error);
        this.estudiantes = [];
      }
    }, 
    async EliminarEstudiante(id){
        if (confirm("Confirma la aliminacion dedl estudiante?")) {
          try {
            const response =await this.axios.delete(`/api/estudiantes/${id}`);
            this.MostrarAlumnos();
            console.log(response);
            
          } catch (error) {
            console.log("error al eliminar el estudiante", error);
          }
        }
    },
  }
};

</script>

<style scoped>
.fondo {
  /* background-color: #D49B2F; 
  background-image: url('../../../../img/untels.jpg'); /* Usa @ si la imagen está en assets 
  background-size: cover;
  background-position: center;*/
  height: 100vh;
}
.container {
  background-color: #c21212; /* Color de fondo suave */
  border-radius: 12px;
  padding: 15px;
  width: 90%;
}
.table {
  width: 100%;
}
.table th, .table td {
  text-align: center;
  vertical-align: middle;
}

.btn {
  transition: all 0.3s ease;
}
.btn:hover {
  transform: translateY(-2px);
}

.btn-sm {
  padding: 8px 16px;
}

.table-bordered {
  border: 1px solid #ddd;
}

.table-head {
  background-color: #007bff;
  color: white;
}

</style>