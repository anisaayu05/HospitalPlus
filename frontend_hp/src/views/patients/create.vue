<script setup>
import { ref } from 'vue';
import api from '../../api';

const name = ref('');
const date_of_birth = ref('');
const gender = ref('');
const address = ref('');
const phone = ref('');
const email = ref('');
const photo_path = ref('');
const medical_history = ref('');

const submitForm = async () => {
    try {
        await api.patients('api/patients', {
            name: name.value,
            date_of_birth: date_of_birth.value,
            gender: gender.value,
            address: address.value,
            phone: phone.value,
            email: email.value,
            photo_path: photo_path.value,
            medical_history: medical_history.value,
        });
        window.location.href = '/patients';
    } catch (error) {
        console.error('Error adding patient:', error);
    }
};
</script>