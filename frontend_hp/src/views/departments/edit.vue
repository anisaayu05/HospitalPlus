<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import api from '../../api';

const name = ref('');
const description = ref('');
const image_path = ref('');

const route = useRoute();
const departmentId = route.params.id;

const fetchDepartments = async () => {
    try {
        const response = await api.get(`api/departments/${departmentId}`);
        const department = response.data;
        name: department.name;
        description: department.description;
        image_path: department.image_path;
    } catch (error) {
        console.error('Error fetching department:', error);
    }
};

const submitForm = async () => {
    try {
        await api.put(`api/departments/${departmentId}`, {
            name: name.value,
            description: description.value,
            image_path: image_path.value,
        });
        window.location.href = '/departments';
    } catch (error) {
        console.error('Error updating department:', error);
    }
};

onMounted(() => {
    fetchDepartments();
});
</script>