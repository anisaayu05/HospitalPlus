<template>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Edit Doctor</h2>

    <!-- Form Edit Dokter -->
    <form @submit.prevent="updateDoctor">
      <div class="form-group">
        <label for="name">Name</label>
        <input
          type="text"
          id="name"
          class="form-control"
          v-model="doctorForm.name"
          required
        />
      </div>
      <div class="form-group">
  <label for="specialization">Specialization</label>
  <select
    id="specialization"
    class="form-control"
    v-model="doctorForm.specialization"
    required
  >
    <option value="" disabled>Select Specialization</option>
    <option value="General Practitioner">General Practitioner</option>
    <option value="Cardiologist">Cardiologist</option>
    <option value="Dermatologist">Dermatologist</option>
    <option value="Neurologist">Neurologist</option>
    <option value="Pediatrician">Pediatrician</option>
    <option value="Orthopedic">Orthopedic</option>
    <option value="Psychiatrist">Psychiatrist</option>
    <option value="Radiologist">Radiologist</option>
    <option value="Surgeon">Surgeon</option>
    <option value="Urologist">Urologist</option>
  </select>
</div>

      <div class="form-group">
        <label for="phone">Phone</label>
        <input
          type="text"
          id="phone"
          class="form-control"
          v-model="doctorForm.phone"
          required
        />
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="email"
          id="email"
          class="form-control"
          v-model="doctorForm.email"
          required
        />
      </div>
      <button type="submit" class="btn btn-primary">Update Doctor</button>
      <router-link to="/doctors" class="btn btn-secondary ml-2">Cancel</router-link>
    </form>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";

export default {
  setup() {
    const doctorForm = ref({
      name: "",
      specialization: "",
      phone: "",
      email: "",
    });

    const route = useRoute();
    const doctorId = route.params.id;

    const fetchDoctor = async () => {
      try {
        const response = await fetch(
          `http://127.0.0.1:8000/api/doctors/${doctorId}`
        );
        const data = await response.json();
        if (data.success) {
          Object.assign(doctorForm.value, data.data);
        }
      } catch (error) {
        console.error("Error fetching doctor:", error);
      }
    };

    const updateDoctor = async () => {
      try {
        const response = await fetch(
          `http://127.0.0.1:8000/api/doctors/${doctorId}`,
          {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(doctorForm.value),
          }
        );
        const data = await response.json();
        if (data.success) {
          alert("Doctor updated successfully!");
          window.location.href = "/doctors";
        } else {
          alert("Failed to update doctor.");
        }
      } catch (error) {
        console.error("Error updating doctor:", error);
        alert("An error occurred. Please try again.");
      }
    };

    onMounted(() => {
      fetchDoctor();
    });

    return {
      doctorForm,
      updateDoctor,
    };
  },
};
</script>
