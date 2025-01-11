<script setup>
import { ref, onMounted } from 'vue';
import api from '../../api'; 

const rooms = ref([]);

const fetchDataRooms = async () => {
    try {
        const response = await api.get('api/rooms');
        rooms.value = response.data;
    } catch (error) {
        console.error('Error fetching room:', error);
    }
};

const deleteRooms = async (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus room ini?')) {
        try {
            await api.delete(`api/rooms/${id}`);
            fetchDataRooms(); 
        } catch (error) {
            console.error('Error deleting room:', error);
        }
    }
};

onMounted(() => {
    fetchDataRooms();
});
</script>