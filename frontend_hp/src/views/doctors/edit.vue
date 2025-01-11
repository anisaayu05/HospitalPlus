<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import api from '../../api';

const name = ref('');
const specialization = ref('');
const phone = ref('');
const email = ref('');

const route = useRoute();
const doctorId = route.params.id;

const fetchDoctors = async () => {
    try {
        const response = await api.get(`api/doctors/${doctorId}`);
        const doctor = response.data;
        name: doctor.name;
        specialization: doctor.specialization;
        phone: doctor.phone;
        email: doctor.email;

    } catch (error) {
        console.error('Error fetching doctor:', error);
    }
};

const submitForm = async () => {
    try {
        await api.put(`api/doctors/${doctorId}`, {
            name: name.value,
            specialization: specialization.value,
            phone: phone.value,
            email: email.value,
        });
        window.location.href = '/departments';
    } catch (error) {
        console.error('Error updating department:', error);
    }
};

onMounted(() => {
    fetchDoctors();
});
</script>