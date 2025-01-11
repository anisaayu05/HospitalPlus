<script setup>
import { ref } from 'vue';
import api from '../../api';

const patient_id = ref('');
const doctor_id = ref('');
const appointment_date = ref('');
const status = ref('');
const notes = ref('');

const submitForm = async () => {
    try {
        await api.appointments('api/appointments', {
            patient_id: patient_id.value,
            doctor_id: doctor_id.value,
            appointment_date: appointment_date.value,
            status: status.value,
            notes: notes.value,
        });
        window.location.href = '/appointments';
    } catch (error) {
        console.error('Error adding appointment:', error);
    }
};
</script>