import { createRouter, createWebHistory } from 'vue-router';
import AppointmentsIndex from '../views/appointments/index.vue';
import AppointmentsCreate from '../views/appointments/create.vue';
import AppointmentsEdit from '../views/appointments/edit.vue';
import DepartmentsIndex from '../views/departments/index.vue';
import DepartmentsCreate from '../views/departments/create.vue';
import DepartmentsEdit from '../views/departments/edit.vue';
import DoctorsIndex from '../views/doctors/index.vue';
import DoctorsCreate from '../views/doctors/create.vue';
import DoctorsEdit from '../views/doctors/edit.vue';
import PatientsIndex from '../views/patients/index.vue';
import PatientsCreate from '../views/patients/create.vue';
import PatientsEdit from '../views/patients/edit.vue';
import RoomsIndex from '../views/rooms/index.vue';
import RoomsCreate from '../views/rooms/create.vue';
import RoomsEdit from '../views/rooms/edit.vue';
import Home from '../views/Home.vue'; // Pastikan ini sudah diimport

const routes = [
    { path: '/', redirect: '/home' },
    { path: '/home', name: 'Home', component: Home },
    { path: '/appointments', name: 'AppointmentsIndex', component: AppointmentsIndex },
    { path: '/appointments/create', name: 'AppointmentsCreate', component: AppointmentsCreate },
    { path: '/appointments/edit/:id', name: 'AppointmentsEdit', component: AppointmentsEdit, props: true },
    { path: '/departments', name: 'DepartmentsIndex', component: DepartmentsIndex },
    { path: '/departments/create', name: 'DepartmentsCreate', component: DepartmentsCreate },
    { path: '/departments/edit/:id', name: 'DepartmentsEdit', component: DepartmentsEdit, props: true },
    { path: '/doctors', name: 'DoctorsIndex', component: DoctorsIndex },
    { path: '/doctors/create', name: 'DoctorsCreate', component: DoctorsCreate },
    { path: '/doctors/edit/:id', name: 'DoctorsEdit', component: DoctorsEdit, props: true },
    { path: '/patients', name: 'PatientsIndex', component: PatientsIndex },
    { path: '/patients/create', name: 'PatientsCreate', component: PatientsCreate },
    { path: '/patients/edit/:id', name: 'PatientsEdit', component: PatientsEdit, props: true },
    { path: '/rooms', name: 'RoomsIndex', component: RoomsIndex },
    { path: '/rooms/create', name: 'RoomsCreate', component: RoomsCreate },
    { path: '/rooms/edit/:id', name: 'RoomsEdit', component: RoomsEdit, props: true },
];

const router = createRouter({
    history: createWebHistory(),
    routes,

    // Aktifkan scroll ke elemen dengan ID hash
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            return {
                el: to.hash, // Scroll ke elemen dengan ID sesuai hash
                behavior: 'smooth', // Scroll animasi halus
            };
        }
        if (savedPosition) {
            return savedPosition; // Kembali ke posisi sebelumnya jika ada
        }
        return { top: 0 }; // Scroll ke atas untuk navigasi biasa
    },
});

export default router;
