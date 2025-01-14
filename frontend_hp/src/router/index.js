import { createRouter, createWebHistory } from 'vue-router';
import AppointmentsCreate from '../views/appointments/create.vue';
import AppointmentsEdit from '../views/appointments/edit.vue';
import AppointmentsIndex from '../views/appointments/index.vue';
import DoctorsCreate from '../views/doctors/create.vue';
import DoctorsEdit from '../views/doctors/edit.vue';
import DoctorsIndex from '../views/doctors/index.vue';
import HealthRecordsCreate from '../views/health-records/create.vue';
import HealthRecordsEdit from '../views/health-records/edit.vue';
import HealthRecordsIndex from '../views/health-records/index.vue';
import Home from '../views/Home.vue';
import MedicalRecordsCreate from '../views/medical-records/create.vue';
import MedicalRecordsEdit from '../views/medical-records/edit.vue';
import MedicalRecordsIndex from '../views/medical-records/index.vue';
import PatientsCreate from '../views/patients/create.vue';
import PatientsEdit from '../views/patients/edit.vue';
import PatientsIndex from '../views/patients/index.vue';
import RoomsCreate from '../views/rooms/create.vue';
import RoomsEdit from '../views/rooms/edit.vue';
import RoomsIndex from '../views/rooms/index.vue';

const routes = [
    { path: '/', redirect: '/home' },
    { path: '/home', name: 'Home', component: Home },
    { path: '/appointments', name: 'AppointmentsIndex', component: AppointmentsIndex },
    { path: '/appointments/create', name: 'AppointmentsCreate', component: AppointmentsCreate },
    { path: '/appointments/edit/:id', name: 'AppointmentsEdit', component: AppointmentsEdit, props: true },
    { path: '/doctors', name: 'DoctorsIndex', component: DoctorsIndex },
    { path: '/doctors/create', name: 'DoctorsCreate', component: DoctorsCreate },
    { path: '/doctors/edit/:id', name: 'DoctorsEdit', component: DoctorsEdit, props: true },
    { path: '/patients', name: 'PatientsIndex', component: PatientsIndex },
    { path: '/patients/create', name: 'PatientsCreate', component: PatientsCreate },
    { path: '/patients/edit/:id', name: 'PatientsEdit', component: PatientsEdit, props: true },
    { path: '/rooms', name: 'RoomsIndex', component: RoomsIndex },
    { path: '/rooms/create', name: 'RoomsCreate', component: RoomsCreate },
    { path: '/rooms/edit/:id', name: 'RoomsEdit', component: RoomsEdit, props: true },
    { path: '/health-records', name: 'HealthRecordsIndex', component: HealthRecordsIndex },
    { path: '/health-records/create', name: 'HealthRecordsCreate', component: HealthRecordsCreate },
    { path: '/health-records/edit/:id', name: 'HealthRecordsEdit', component: HealthRecordsEdit, props: true },
    { path: '/medical-records', name: 'MedicalRecordsIndex', component: MedicalRecordsIndex },
    { path: '/medical-records/create', name: 'MedicalRecordsCreate', component: MedicalRecordsCreate },
    { path: '/medical-records/edit/:id', name: 'MedicalRecordsEdit', component: MedicalRecordsEdit, props: true },

];

const router = createRouter({
    history: createWebHistory(),
    routes,

    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            return {
                el: to.hash, 
                behavior: 'smooth',
            };
        }
        if (savedPosition) {
            return savedPosition; 
        }
        return { top: 0 };
    },
});

export default router;
