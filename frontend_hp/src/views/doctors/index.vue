<template>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Doctor Management</h2>

    <!-- Form untuk Create/Update Doctor -->
    <form @submit.prevent="saveDoctor">
      <div class="form-group">
        <label for="doctor-name">Doctor Name</label>
        <input
          type="text"
          id="doctor-name"
          class="form-control"
          v-model="doctorForm.name"
          placeholder="Enter Doctor Name"
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
        <label for="doctor-phone">Phone</label>
        <input
          type="text"
          id="doctor-phone"
          class="form-control"
          v-model="doctorForm.phone"
          placeholder="Enter Phone Number"
          required
        />
      </div>
      <div class="form-group">
        <label for="doctor-email">Email</label>
        <input
          type="email"
          id="doctor-email"
          class="form-control"
          v-model="doctorForm.email"
          placeholder="Enter Email Address"
          required
        />
      </div>
      <button type="submit" class="btn btn-primary">
        {{ doctorForm.id ? "Update Doctor" : "Save Doctor" }}
      </button>
      <button
        type="button"
        class="btn btn-secondary ml-2"
        v-if="doctorForm.id"
        @click="resetForm"
      >
        Cancel
      </button>
    </form>

    <hr class="my-5" />

    <!-- Tabel Doctor List -->
    <h3 class="text-center">Doctor List</h3>
    <div class="table-responsive">
      <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Specialization</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="doctor in doctors" :key="doctor.id">
            <td>{{ doctor.name }}</td>
            <td>{{ doctor.specialization }}</td>
            <td>{{ doctor.phone }}</td>
            <td>{{ doctor.email }}</td>
            <td>
              <button class="btn btn-warning btn-sm" @click="editDoctor(doctor)">
                Edit
              </button>
              <button
                class="btn btn-danger btn-sm"
                @click="deleteDoctor(doctor.id)"
              >
                Delete
              </button>
            </td>
          </tr>
          <tr v-if="doctors.length === 0">
            <td colspan="5" class="text-center">No doctors available</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      doctors: [], // Data doctors
      doctorForm: {
        id: null,
        name: "",
        specialization: "",
        phone: "",
        email: "",
      },
    };
  },
  methods: {
    async fetchDoctors() {
      try {
        const response = await fetch("http://127.0.0.1:8000/api/doctors");
        const data = await response.json();
        if (data.success) {
          this.doctors = data.data;
        } else {
          console.error("Failed to fetch doctors:", data.message);
        }
      } catch (error) {
        console.error("Error fetching doctors:", error);
      }
    },

    async saveDoctor() {
      const method = this.doctorForm.id ? "PUT" : "POST";
      const url = this.doctorForm.id
        ? `http://127.0.0.1:8000/api/doctors/${this.doctorForm.id}`
        : "http://127.0.0.1:8000/api/doctors";

      try {
        const response = await fetch(url, {
          method: method,
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(this.doctorForm),
        });

        const data = await response.json();
        if (data.success) {
          alert(
            `Doctor ${this.doctorForm.id ? "updated" : "created"} successfully!`
          );
          this.fetchDoctors();
          this.resetForm();
        } else {
          alert(`Failed to ${this.doctorForm.id ? "update" : "create"} doctor.`);
        }
      } catch (error) {
        console.error("Error saving doctor:", error);
        alert("An error occurred. Please try again.");
      }
    },

    editDoctor(doctor) {
      this.doctorForm = { ...doctor };
    },

    async deleteDoctor(id) {
      if (confirm("Are you sure you want to delete this doctor?")) {
        try {
          const response = await fetch(
            `http://127.0.0.1:8000/api/doctors/${id}`,
            { method: "DELETE" }
          );
          const result = await response.json();
          if (result.success) {
            this.fetchDoctors();
          } else {
            console.error("Error deleting doctor:", result.message);
          }
        } catch (error) {
          console.error("Error deleting doctor:", error);
        }
      }
    },

    resetForm() {
      this.doctorForm = {
        id: null,
        name: "",
        specialization: "",
        phone: "",
        email: "",
      };
    },
  },
  mounted() {
    this.fetchDoctors();
  },
};
</script>

<style scoped>
.container {
  max-width: 800px;
}
.table-responsive {
  background-color: #1c1c1c;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}
</style>
