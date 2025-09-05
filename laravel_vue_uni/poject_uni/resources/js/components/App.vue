
<template>

  <main>
    <!-- Siderbar -->
    <div id="sidebar" class="bg-dark" :class="{ collapsed: isCollapsed }">
      <button id="toggle-btn" class="btn btn-light btn-sm" @click="toggleSidebar">☰</button>
      <ul class="nav flex-column mt-3">
        <li class="nav-item">
          <router-link :to="{name:'inicioAdministrativo'}" class="nav-link">Inicio</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{name:'listarEstudiante'}" class="nav-link">Estudiantes</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{name:'listarRegistroEstacionamiento'}" class="nav-link">Registros de estacionamiento</router-link>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Configuración</a>
        </li>
      </ul>
    </div>

    <!-- Contenido principal -->
    <div id="main">
      <router-view></router-view>

    <footer>   
      <p>&copy; 2025 Mi Aplicación</p>
    </footer>
    </div>

  </main>
</template>

<script setup>
  import { ref } from 'vue'

  const isCollapsed = ref(false)

  function toggleSidebar() {
    isCollapsed.value = !isCollapsed.value
  }
</script>

<style scoped>

#sidebar {
  width: 200px;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  overflow: hidden;
  transition: all 0.3s;
  z-index: 999;
}

#sidebar.collapsed {
  width: 45px;
}

#sidebar .nav-link {
  color: rgb(255, 255, 255);
}

#sidebar .nav-link:hover {
  background-color: #140878;
}

/* Contenido principal */
#main {
  background-image: url('../../img/untels.jpg'); /* Usa @ si la imagen está en assets */
  background-size: cover;
  background-position: center;
  flex: 1;
  margin-left: 200px;
  transition: all 0.3s;
  min-height: 100vh; /* Cambiado de height a min-height */
  display: flex;
  flex-direction: column;
}

footer {
  background-color: #e24848ff;
  padding: 10px;
  text-align: center;
  margin-top: auto;
}

#sidebar.collapsed + #main{
  margin-left: 45px;
}

/* Botón de toggle */
#toggle-btn {
  margin: 10px;
}
</style>
