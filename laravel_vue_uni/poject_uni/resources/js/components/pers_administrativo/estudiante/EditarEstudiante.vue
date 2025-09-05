    <template>
        <!-- formulario crear estudiante -->
        <div class="editar-estudiante">
            <h2>Editar Estudiante</h2>
            <form @submit.prevent="editarEstudiante">
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
                    v-model="estudiante.fecha_nacimiento"
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

                <!-- <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input
                    type="file"
                    class="form-control"
                    id="foto"
                    @change="handleFileUpload"
                    />
                </div> -->
                <button type="submit" class="btn btn-primary">Editar Estudiante</button>
            </form>
        </div>
        <!-- End formulario crear estudiante -->
    </template>

    <script>

    export default{
        name:'editar-estudiante',
        // data(){
        //     return{
        //         estudiante: {},
        //         despuesEstudiante: {},
        //     }
        // },
        data(){
            return{
                estudiante: {
                    nombres:'',
                    apellidos: '',
                    edad:'',
                    fecha_nacimiento: '',
                    dni: '',
                    email: '',
                    foto: '',
                },
            };
        }, 
        mounted(){
            this.mostrarDatosEstudiante();
        },
        methods:{
            // metodo para traer a los estudiantes
            async mostrarDatosEstudiante(){
                try {
                const response =  await this.axios.get(`/api/estudiantes/${this.$route.params.id}`);
                this.estudiante = response.data;
                console.log(`Datos antes de editar estudiantes(en mostrarEstudiantes):`);
                console.log(this.estudiante);
                } catch (error) {
                    console.log('error encontrao', error);
                }
            },
            //metodo para guardar la imagen 
            handleFileUpload(event){
                const file = event.target.files[0];
                if (file) {
                    this.estudiante.foto = file;
                }
            },

            async editarEstudiante() {
                const editar = new FormData();
                editar.append('nombres', this.estudiante.nombres);
                editar.append('apellidos', this.estudiante.apellidos);
                editar.append('edad', this.estudiante.edad);
                editar.append('fecha_nacimiento', this.estudiante.fecha_nacimiento);
                editar.append('dni', this.estudiante.dni);
                editar.append('email', this.estudiante.email);
                editar.append('codigo', this.estudiante.codigo);
                editar.append('_method', 'PUT');
                if (this.estudiante.foto) {
                    editar.append('foto', this.estudiante.foto);
                }
                try {
                    console.log("datos a enviar: ");
                    editar.forEach((value, key) => {
                    console.log(key + ': ' + value);
                    });

                    const response = await this.axios.post(`/api/estudiantes/${this.$route.params.id}`, editar, {
                        headers: {
                        'Content-Type': 'multipart/form-data', // Es importante que el encabezado sea 'multipart/form-data'
                    },
                    })
                    this.$router.push({name:'listarEstudiantes'});
                } catch (error) {
                    console.log('Error al editar estudiante', error);
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