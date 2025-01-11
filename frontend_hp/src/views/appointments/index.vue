<script setup>
import { ref, onMounted } from 'vue';
import api from '../../api';

const appointments = ref([]);

const fetchDataAppointments = async () => {
    try {
        const response = await api.get('api/appointments');
        appointments.value = response.data;
    } catch (error) {
        console.error('Error fetching appointments:', error);
    }
};

const deleteAppointments = async (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus appointment ini?')) {
        try {
            await api.delete(`api/appointments/${id}`);
            fetchDataAppointments();
        } catch (error) {
            console.error('Error deleting appointment:', error);
        }
    }
};

onMounted(() => {
    fetchDataAppointments();
});
</script>