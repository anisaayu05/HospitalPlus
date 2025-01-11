<script setup>
import { ref, onMounted } from 'vue';
import api from '../../api';

const patients = ref([]);

const fetchDataPatients = async () => {
    try {
        const response = await api.get('api/patients');
        patients.value = response.data;
    } catch (error) {
        console.error('Error fetching patients:', error);
    }
};

const deletePatients = async (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus patient ini?')) {
        try {
            await api.delete(`api/patients/${id}`);
            fetchDataPatients();
        } catch (error) {
            console.error('Error deleting patient:', error);
        }
    }
};

onMounted(() => {
    fetchDataPatients();
});
</script>