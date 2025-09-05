<template>
    <div class="formulario container">

        <div class=" tex-center">
            <h1>Registrar entrada</h1>
        </div>

        <!-- Datos estudainte -->

        <!-- Busqueda de estudiante (por codigo) -->
        <div class="busquedaEstudiante">
            <form @submit.prevent="buscarEstudiante" class="input-group mb-3">
                <input type="number" class="form-control" placeholder="Ingrese codigo de estudiante" v-model="buscar"/>
                <button class="btn btn-outline-secondary" type="submit" >
                    Buscar
                </button>
            </form>
         </div>
        <!-- Datos encontrados -->
        <div class="datosEstudiante" v-if="estudiante != null && Object.keys(estudiante).length > 0">
            <div class="row align-items-start">
                <h1>Datos estudiante</h1>
                <!-- columna izquierda -->
                <div class="col">
                    <label class="form-label" for="nombre">Nombres del estudiante </label>
                    <input class="form-control" type="text" id="nombre" v-model="estudiante.nombres"/>
                    <label class="form-label" for="nombre">Apellidos del estudiante </label>
                    <input class="form-control" type="text" id="nombre" v-model="estudiante.apellidos"/>
                    <label class="form-label" for="nombre">Codigo del estudiante </label>
                    <input class="form-control" type="text" id="nombre" v-model="estudiante.codigo"/>
                </div>
                <!-- columna derecha -->
                <div class="col">
                    <div class="row align-items-start">
                        <div class="col-9">
                            <h1>FOTO</h1>
                        </div>
                    </div>
                    <div class="row align-items-end">
                        <div class="col">
                            <label class="form-label" for="ciclo">Ciclo </label>
                            <input class="form-control" type="text" value="9" id="ciclo" />
                        </div>
                        <div class="col">
                            <label class="form-label" for="carrera">Carrera </label>
                            <input class="form-control" type="text" value="Ingenieria de sistemas" id="carrera" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End datos estudainte -->

        <!-- Datos vehiculo -->
        <form @submit.prevent="agregarRegistro">
            <div class="datosVehiculo">
                <div class="row align-items-start">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <label class="form-label" for="fechaIngreso"> Fecha y hora de ingreso</label>
                                <input class="form-control" type="text" id="fechaIngreso" v-model="fecha_actual">

                                <label class="form-label" for="tipo"> Tipo de vehiculo</label>
                                <select id="tipo" class="form-select" aria-label="Default select example" v-model="registro.tipo_vehiculo">
                                    <option selected>Seleccionar</option>
                                    <option value="Carro">Carro</option>
                                    <option value="moto">moto</option>
                                    <option value="moto taxi">moto taxi</option>
                                    <option value="bicicleta">bicicleta</option>
                                    <option value="scooter">scooter</option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="form-label" for="fechaSalida"> Fecha y hora de salida</label>
                                <input class="form-control" type="text" id="fechaSalida">

                                <label class="form-label" for="placa"> Placa</label>
                                <input class="form-control" type="text" id="placa" v-model="registro.placa_vehiculo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="form-label" >Descripcion</label>
                                <textarea class="form-control"  style="height: 100px" v-model="registro.descripcion_vehiculo"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" @change="handleFileUpload"/>
                        <img id="preview" width="200">
                    </div>

                </div>
                <button type="submit" class="form-control"> Guardar registro</button>
            </div>
        </form>
        <!-- End datos vehiculo -->

    </div>
</template>

<script>
export default{
    name:'crear-registroEstacionamiento',
    data(){
        return{
            fecha_actual: new Date().toISOString(),
            buscar: null,
            estudiante: {},
            registro:{
                placa_vehiculo:'',
                tipo_vehiculo:'',
                descripcion_vehiculo:'',
                foto:'soy la foto',
            }
        }
    },
    mounted(){
        this.obtenerFechaHora();
    },
    methods:{
        async buscarEstudiante(){
            try {
                console.log(this.buscar);
                const response = await this.axios.get(`/api/estacionamiento/estudiante/${this.buscar}`);
                this.estudiante = response.data.estudiante;
                console.log(this.estudiante);
            } catch (error) {
                console.log("error al traer datos de mi api buscar: ",error);
            }
        },

        handleFileUpload(event){
            //mostrar imagen antes de enviar
            const img = document.getElementById("preview");
            img.src = URL.createObjectURL(event.target.files[0])

            const file = event.target.files[0];
            console.log("foto antes", this.registro.foto);

            if (file) {
                this.registro.foto = file;
                console.log("foto despues de guardaar",this.registro.foto);
            }
        },
        
        async obtenerFechaHora() {
        //https://docs.abstractapi.com/timezones/current-time?playground=open
        //https://app.abstractapi.com/api/timezone/tester
        const url = 'https://timezone.abstractapi.com/v1/current_time?api_key=040b0f44ec684268b42de3b9d232ba9a&location=peru';
        const options = {method: 'GET', body: undefined};

        try {
        const response = await fetch(url, options);
        const data = await response.json();
        this.fecha_actual = data.datetime;
        //console.log(data.datetime);
        } catch (error) {
        console.error(error);
        }
        },

        async agregarRegistro(){
            const registro = new FormData();
            registro.append('fecha_ingreso', this.fecha_actual);
            registro.append('placa_vehiculo', this.registro.placa_vehiculo);
            registro.append('tipo_vehiculo', this.registro.tipo_vehiculo);
            registro.append('descripcion_vehiculo', this.registro.descripcion_vehiculo);
            registro.append('estudiante_id', this.estudiante.estudiante_id);
            if (this.registro.foto) {
                registro.append('foto', this.registro.foto);
            }
            // console.log("datos a enviar: ");
            // registro.forEach((value, key) => {
            // console.log(key + ': ' + value);
            // });

            try {
                const response = await this.axios.post(`/api/estacionamiento`, registro,{
                    headers:{
                        'Content-Type': 'multipart/form-data',
                    }
                });
                console.log('respuesta de la api: ', response)
                
            } catch (error) {
                console.log('erro al registrar el registro: ', error)
            }


        }

    }
}
</script>

<style scoped>
.formulario{
    background-color: aqua;
    width: 70%;
    width: 100%;
    height: 100vh;
}
.datosEstudiante{
    background-color: aliceblue;
}
.datosVehiculo{
    background-color: rgb(164, 213, 155);
}
</style>

