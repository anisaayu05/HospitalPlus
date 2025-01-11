<script setup>
import { ref } from 'vue';
import api from '../../api';

const name = ref('');
const description = ref('');
const image_path = ref('');

const submitForm = async () => {
    try {
        await api.departments('api/departments', {
            name: name.value,
            description: description.value,
            image_path: image_path.value,
        });
        window.location.href = '/departments';
    } catch (error) {
        console.error('Error adding department:', error);
    }
};
</script>