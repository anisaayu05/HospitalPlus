<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import api from '../../api';

const patient_id = ref('');
const doctor_id = ref('');
const appointment_date = ref('');
const status = ref('');
const notes = ref('');


const route = useRoute();
const appointmentId = route.params.id;

const fetchAppointments = async () => {
    try {
        const response = await api.get(`api/appointments/${appointmentId}`);
        const appointment = response.data;
        patient_id: appointment.patient_id;
        doctor_id: appointment.doctor_id;
        appointment_date: appointment.appointment_date;
        status: appointment.status;
        notes: appointment.notes;
    } catch (error) {
        console.error('Error fetching appointment:', error);
    }
};

const submitForm = async () => {
    try {
        await api.put(`api/appointments/${appointmentId}`, {
            patient_id: patient_id.value,
            doctor_id: doctor_id.value,
            appointment_date: appointment_date.value,
            status: status.value,
            notes: notes.value,
        });
        window.location.href = '/appointments';
    } catch (error) {
        console.error('Error updating appointment:', error);
    }
};

onMounted(() => {
    fetchAppointments();
});
</script>