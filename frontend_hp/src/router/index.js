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

const routes = [
    { path: '/', redirect: '/appointments' },
    { path: '/appointments', name: 'AppointmentsIndex', component: AppointmentsIndex },
    { path: '/appointments/create', name: 'AppointmentsCreate', component: AppointmentsCreate },
    { path: '/appointments/edit/:id', name: 'AppointmentsEdit', component: AppointmentsEdit, props: true },
    
    { path: '/', redirect: '/departments' },
    { path: '/departments', name: 'DepartmentsIndex', component: DepartmentsIndex },
    { path: '/departments/create', name: 'DepartmentsCreate', component: DepartmentsCreate },
    { path: '/departments/edit/:id', name: 'DepartmentsEdit', component: DepartmentsEdit, props: true },
    
    { path: '/', redirect: '/doctors' },
    { path: '/doctors', name: 'DoctorsIndex', component: DoctorsIndex },
    { path: '/doctors/create', name: 'DoctorsCreate', component: DoctorsCreate },
    { path: '/doctors/edit/:id', name: 'DoctorsEdit', component: DoctorsEdit, props: true },
    
    { path: '/', redirect: '/patients' },
    { path: '/patients', name: 'PatientsIndex', component: PatientsIndex },
    { path: '/patients/create', name: 'PatientsCreate', component: PatientsCreate },
    { path: '/patients/edit/:id', name: 'PatientsEdit', component: PatientsEdit, props: true },
    
    { path: '/', redirect: '/rooms' },
    { path: '/rooms', name: 'RoomsIndex', component: RoomsIndex },
    { path: '/rooms/create', name: 'RoomsCreate', component: RoomsCreate },
    { path: '/rooms/edit/:id', name: 'RoomsEdit', component: RoomsEdit, props: true },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
