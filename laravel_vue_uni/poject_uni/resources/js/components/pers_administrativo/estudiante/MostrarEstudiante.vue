<template>
  <div class="container mt-5">
    <div class="card shadow-lg rounded">
      <div class="card-header bg-primary text-white">
        <h3>Detalles del Estudiante</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <p><strong>Nombre:</strong> {{ estudiante.nombres }} {{ estudiante.apellidos }}</p>
            <p><strong>Edad:</strong> {{ estudiante.edad }} años</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ estudiante.fecha_nacimiento }}</p>
            <p><strong>DNI:</strong> {{ estudiante.dni }}</p>
            <p><strong>Código:</strong> {{ estudiante.codigo }}</p>
            <p><strong>Email:</strong> {{ estudiante.email }}</p>
          </div>
          <div class="col-md-6 text-center">
            <img v-if="estudiante.foto" :src="`/storage/${estudiante.foto}`" class="img-fluid rounded-circle border" alt="Foto del Estudiante">
            <p v-else>No hay foto disponible</p>
          </div>
        </div>

        <!-- Botones -->
        <div class="row mt-4">
          <!-- Boton atras -->
          <div class="col-md-6 text-center">
            <router-link :to="{name:'listarEstudiante'}" class="btn btn-outline-primary btn-lg mb-3">
              Atras
            </router-link>
          </div>
          <!-- Boton editar -->
          <div class="col-md-6 text-center">  
            <router-link :to="{name:'editarEstudiante', params:{id:this.$route.params.id}}" class="btn btn-primary btn-lg mb-3">
              Editar
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      estudiante: [],
    };
  },
  mounted() {
    this.mostrarEstudiante();
  },
  methods: {
    async mostrarEstudiante() {
      try {
        const response = await this.axios.get(`/api/estudiantes/${this.$route.params.id}`);
        this.estudiante = response.data;
        // console.log(this.estudiante);
      } catch (error) {
        console.log('error encontrado', error);
      }
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 700px;
  margin: 0 auto;
  padding-top: 30px;
  padding-bottom: 30px;
}

.card {
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(207, 39, 39, 0.1);
  overflow: hidden;
}

.card-header {
  background-color: #007bff;
  color: #fff;
  padding: 20px;
  text-align: center;
  border-radius: 10px 10px 0 0;
}

.card-body {
  padding: 20px;
}

.card-body p {
  font-size: 1.1rem;
  margin-bottom: 15px;
}

.card-body img {
  max-width: 150px;
  height: auto;
  border: 3px solid #ddd;
  padding: 5px;
  border-radius: 50%;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn {
  width: 100%;
  font-size: 1.1rem;
  padding: 12px;
}

.btn-outline-primary {
  background-color: transparent;
  color: #007bff;
  border: 2px solid #007bff;
  transition: all 0.3s ease;
}

.btn-outline-primary:hover {
  background-color: #007bff;
  color: #fff;
}

.btn-primary {
  background-color: #007bff;
  border: none;
  transition: all 0.3s ease;
}

.btn-primary:hover {
  background-color: #0056b3;
}

.row.mt-4 {
  margin-top: 20px;
}
</style>
