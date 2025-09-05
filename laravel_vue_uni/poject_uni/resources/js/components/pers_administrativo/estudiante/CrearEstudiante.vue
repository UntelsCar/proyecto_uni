<template>
    <!-- formulario crear estudiante -->
    <div class="crear-estudiante">
        <h2>Crear Estudiante</h2>
        <form @submit.prevent="crearEstudiante">
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input
                type="text"
                class="form-control"
                id="nombres"
                v-model="estudiante.nombres"
                required
                />
            </div>

            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input
                type="text"
                class="form-control"
                id="apellidos"
                v-model="estudiante.apellidos"
                required
                />
            </div>

            <div class="mb-3">
                <label for="edad" class="form-label">Edad</label>
                <input
                type="number"
                class="form-control"
                id="edad"
                v-model="estudiante.edad"
                required
                />
            </div>

            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                <input
                type="date"
                class="form-control"
                id="fechaNacimiento"
                v-model="estudiante.fechaNacimiento"
                required
                />
            </div>

            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input
                type="text"
                class="form-control"
                id="dni"
                v-model="estudiante.dni"
                required
                />
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                type="email"
                class="form-control"
                id="email"
                v-model="estudiante.email"
                required
                />
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input
                type="file"
                class="form-control"    
                id="foto"
                @change="handleFileUpload"
                />
            </div>
            <button type="submit" class="btn btn-primary">Crear Estudiante</button>
        </form>
    </div>
    <!-- End formulario crear estudiante -->
</template>

<script>

export default{
    name:'crear-estudiante',
    data(){
        return{
            estudiante: {
                nombres:'',
                apellidos: '',
                edad:'',
                fechaNacimiento: '',
                dni: '',
                email: '',
                foto: '',
            },
        };
    },
    
    methods:{
        handleFileUpload(event){
            const file = event.target.files[0];
            if (file) {
                this.estudiante.foto = file;
            }
        },

        //metodo para crear un estudiante, envia la informacion al backend
        async crearEstudiante() {
            const formData = new FormData();
            // Agregar todos los datos del estudiante al FormData
            formData.append('nombres', this.estudiante.nombres);
            formData.append('apellidos', this.estudiante.apellidos);
            formData.append('edad', this.estudiante.edad);
            formData.append('fecha_nacimiento', this.estudiante.fechaNacimiento);
            formData.append('dni', this.estudiante.dni);
            formData.append('email', this.estudiante.email);

            // Agregar el archivo de la foto (si está presente)
            if (this.estudiante.foto) {
                formData.append('foto', this.estudiante.foto);
            }
            try {
                const response = await this.axios.post('/api/estudiantes', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data', // Es importante que el encabezado sea 'multipart/form-data'
                    },  
                });
                console.log(response);
                this.$router.push({ name: 'listarEstudiantes' });
            } catch (error) {
                console.log('Error al crear estudiante', error);
            }
        },
    }
}
</script>

<style scoped>
.crear-estudiante {
  max-width: 600px;
  margin: 0 auto;
}
</style>