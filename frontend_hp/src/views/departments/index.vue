<script setup>
import { ref, onMounted } from 'vue';
import api from '../../api';

const departments = ref([]);

const fetchDataDepartments = async () => {
    try {
        const response = await api.get('api/departments');
        departments.value = response.data;
    } catch (error) {
        console.error('Error fetching department:', error);
    }
};

const deleteDepartments = async (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus department ini?')) {
        try {
            await api.delete(`api/departments/${id}`);
            fetchDataDepartments();
        } catch (error) {
            console.error('Error deleting department:', error);
        }
    }
};

onMounted(() => {
    fetchDataDepartments();
});
</script>