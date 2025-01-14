<template>
  <div id="app">
    <!-- Navbar or Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100 px-4 py-3">
  <router-link to="/" class="navbar-brand ms-3">
    <img src="./assets/img/logohospitalplus.png" alt="HospitalPlus Logo" style="height: 50px; padding-left: 15%">
  </router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav mx-auto" style="gap: 2rem; display: flex; justify-content: center; align-items: center;">
    <li class="nav-item">
      <router-link to="/" class="nav-link">Home</router-link>
    </li>
  
  <li class="nav-item">
    <router-link to="/home#features" class="nav-link">Features</router-link>
  </li>
  <li class="nav-item">
    <router-link to="/home#departments" class="nav-link">Departments</router-link>
  </li>
  <li class="nav-item">
    <router-link to="/home#contact" class="nav-link">Contact</router-link>
  </li>
</ul>

</div>
    </nav>

    <!-- Main Content -->
    <div class="content">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style>
body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #212e3b;
}

.navbar {
  width: 100%;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.navbar-nav {
  gap: 2rem; /* Jarak antar elemen navbar */
}

.nav-link {
  font-size: 1rem; /* Ukuran font */
  font-weight: 500; /* Ketebalan font */
  color: white; /* Warna teks */
  transition: color 0.3s ease; /* Animasi hover */
}

.nav-link:hover {
  color: #f8c102; /* Warna teks saat hover */
}

.navbar-nav .nav-item {
  padding: 0 0.5rem; /* Tambahkan padding horizontal kecil */
}

.navbar-nav .nav-link {
  font-size: 16px;
  font-weight: 600;
  color: white !important;
  transition: color 0.3s ease-in-out;
}

.navbar-nav .nav-link:hover {
  color: #3dbdec !important;
}

.navbar-brand {
  font-family: 'Roboto', sans-serif;
}

.content {
  width: 100%;
  margin: 0;
  padding: 0;
  min-height: calc(100vh - 56px - 64px); /* Adjusts for navbar and footer heights */
}

.btn-warning {
  background-color: #3dbdec;
  border: none;
}

.btn-warning:hover {
  background-color: #3dbdec;
}

@media (max-width: 767px) {
  .navbar-nav .nav-link {
    font-size: 16px;
  }
  .navbar-toggler {
    background-color: #3dbdec;
  }
}
</style>
