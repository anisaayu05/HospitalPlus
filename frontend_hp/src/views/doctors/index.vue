<script setup>
import { ref, onMounted } from 'vue';
import api from '../../api';

const doctors = ref([]);

const fetchDataDoctors = async () => {
    try {
        const response = await api.get('api/doctors');
        doctors.value = response.data;
    } catch (error) {
        console.error('Error fetching doctor:', error);
    }
};

const deleteDoctors = async (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus doctor ini?')) {
        try {
            await api.delete(`api/doctors/${id}`);
            fetchDataDoctors();
        } catch (error) {
            console.error('Error deleting doctor:', error);
        }
    }
};

onMounted(() => {
    fetchDataDoctors();
});
</script>