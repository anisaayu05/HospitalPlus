<template>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Edit Patient</h2>

    <!-- Form Edit Pasien -->
    <form @submit.prevent="updatePatient">
      <div class="form-group">
        <label for="name">Name</label>
        <input
          type="text"
          id="name"
          class="form-control"
          v-model="patientForm.name"
          required
        />
      </div>
      <div class="form-group">
        <label for="date_of_birth">Date of Birth</label>
        <input
          type="date"
          id="date_of_birth"
          class="form-control"
          v-model="patientForm.date_of_birth"
          required
        />
      </div>
      <div class="form-group">
        <label for="gender">Gender</label>
        <select
          id="gender"
          class="form-control"
          v-model="patientForm.gender"
          required
        >
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input
          type="text"
          id="address"
          class="form-control"
          v-model="patientForm.address"
          required
        />
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input
          type="text"
          id="phone"
          class="form-control"
          v-model="patientForm.phone"
          required
        />
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="email"
          id="email"
          class="form-control"
          v-model="patientForm.email"
          required
        />
      </div>
      <div class="form-group">
        <label for="photo">Photo</label>
        <input
          type="file"
          id="photo"
          class="form-control"
          @change="handlePhotoUpload"
        />
      </div>
      <div class="form-group">
        <label for="medical_history">Medical History</label>
        <textarea
          id="medical_history"
          class="form-control"
          v-model="patientForm.medical_history"
          rows="3"
        ></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Update Patient</button>
      <router-link to="/patients" class="btn btn-secondary ml-2">Cancel</router-link>
    </form>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";

export default {
  setup() {
    const patientForm = ref({
      name: "",
      date_of_birth: "",
      gender: "male",
      address: "",
      phone: "",
      email: "",
      photo_path: "",
      medical_history: "",
    });

    const route = useRoute();
    const patientId = route.params.id;

    const fetchPatient = async () => {
      try {
        const response = await fetch(
          `http://127.0.0.1:8000/api/patients/${patientId}`
        );
        const data = await response.json();
        if (data.success) {
          Object.assign(patientForm.value, data.data);
        }
      } catch (error) {
        console.error("Error fetching patient:", error);
      }
    };

    const updatePatient = async () => {
      try {
        const formData = new FormData();
        Object.keys(patientForm.value).forEach((key) => {
          formData.append(key, patientForm.value[key]);
        });

        const response = await fetch(
          `http://127.0.0.1:8000/api/patients/${patientId}`,
          {
            method: "PUT",
            body: formData,
          }
        );
        const data = await response.json();
        if (data.success) {
          alert("Patient updated successfully!");
          window.location.href = "/patients";
        } else {
          alert("Failed to update patient.");
        }
      } catch (error) {
        console.error("Error updating patient:", error);
        alert("An error occurred. Please try again.");
      }
    };

    const handlePhotoUpload = (event) => {
      patientForm.value.photo_path = event.target.files[0];
    };

    onMounted(() => {
      fetchPatient();
    });

    return {
      patientForm,
      updatePatient,
      handlePhotoUpload,
    };
  },
};
</script>
