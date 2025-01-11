<script setup>
import { ref } from 'vue';
import api from '../../api';

const name = ref('');
const type = ref('');
const capacity = ref('');
const status = ref('');
const notes = ref('');

const submitForm = async () => {
    try {
        await api.rooms('api/rooms', {
            name: name.value,
            type: type.value,
            capacity: capacity.value,
            status: status.value,
            notes: notes.value,
        });
        window.location.href = '/rooms';
    } catch (error) {
        console.error('Error adding room:', error);
    }
};
</script>