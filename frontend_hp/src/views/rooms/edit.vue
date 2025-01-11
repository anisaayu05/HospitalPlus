<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import api from '../../api';

const name = ref('');
const type = ref('');
const capacity = ref('');
const status = ref('');
const notes = ref('');
const route = useRoute();
const roomId = route.params.id;

const fetchRooms = async () => {
    try {
        const response = await api.get(`api/rooms/${roomId}`);
        const room = response.data;
        name: room.name;
        type: room.type;
        capacity: room.capacity;
        status: room.status;
        notes: room.notes;

    } catch (error) {
        console.error('Error fetching rooms:', error);
    }
};

const submitForm = async () => {
    try {
        await api.put(`api/rooms/${roomId}`, {
            name: name.value,
            type: type.value,
            capacity: capacity.value,
            status: status.value,
            notes: notes.value,
        });
        window.location.href = '/rooms';
    } catch (error) {
        console.error('Error updating room:', error);
    }
};

onMounted(() => {
    fetchRooms();
});
</script>