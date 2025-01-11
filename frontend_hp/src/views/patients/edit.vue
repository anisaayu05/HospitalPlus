<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import api from '../../api';

const name = ref('');
const date_of_birth = ref('');
const gender = ref('');
const address = ref('');
const phone = ref('');
const email = ref('');
const photo_path = ref('');
const medical_history = ref('');
const route = useRoute();
const patientId = route.params.id;

const fetchPatients = async () => {
    try {
        const response = await api.get(`api/patients/${patientId}`);
        const patient = response.data;
        name: patient.name;
        date_of_birth: patient.date_of_birth;
        gender: patient.gender;
        address: patient.address;
        phone: patient.phone;
        email: patient.email;
        photo_path: patient.photo_path;
        medical_history: patient.medical_history;

    } catch (error) {
        console.error('Error fetching patient:', error);
    }
};

const submitForm = async () => {
    try {
        await api.put(`api/patients/${patientId}`, {
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
        console.error('Error updating patient:', error);
    }
};

onMounted(() => {
    fetchPatients();
});
</script>