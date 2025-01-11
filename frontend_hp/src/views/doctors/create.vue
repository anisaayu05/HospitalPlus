<script setup>
import { ref } from 'vue';
import api from '../../api';

const name = ref('');
const specialization = ref('');
const phone = ref('');
const email = ref('');

const submitForm = async () => {
    try {
        await api.doctors('api/doctors', {
            name: name.value,
            specialization: specialization.value,
            phone: phone.value,
            email: email.value,
        });
        window.location.href = '/doctors';
    } catch (error) {
        console.error('Error adding doctor:', error);
    }
};
</script>