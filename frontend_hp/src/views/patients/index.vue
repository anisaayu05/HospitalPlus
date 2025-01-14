<template>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Patient Management</h2>

    <!-- Form untuk Create/Update Patient -->
    <form @submit.prevent="savePatient">
      <div class="form-group">
        <label for="name">Name</label>
        <input
          type="text"
          id="name"
          class="form-control"
          v-model="patientForm.name"
          placeholder="Enter Patient Name"
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
          placeholder="Enter Address"
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
          placeholder="Enter Phone Number"
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
          placeholder="Enter Email Address"
          required
        />
      </div>
      <button type="submit" class="btn btn-primary">
        {{ patientForm.id ? "Update Patient" : "Save Patient" }}
      </button>
      <button
        type="button"
        class="btn btn-secondary ml-2"
        v-if="patientForm.id"
        @click="resetForm"
      >
        Cancel
      </button>
    </form>

    <hr class="my-5" />

    <!-- Tabel Patient List -->
    <h3 class="text-center">Patient List</h3>
    <div class="table-responsive">
      <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="patient in patients" :key="patient.id">
            <td>{{ patient.name }}</td>
            <td>{{ patient.date_of_birth }}</td>
            <td>{{ patient.gender }}</td>
            <td>{{ patient.phone }}</td>
            <td>{{ patient.email }}</td>
            <td>
              <button class="btn btn-warning btn-sm" @click="editPatient(patient)">
                Edit
              </button>
              <button
                class="btn btn-danger btn-sm"
                @click="deletePatient(patient.id)"
              >
                Delete
              </button>
            </td>
          </tr>
          <tr v-if="patients.length === 0">
            <td colspan="6" class="text-center">No patients available</td>
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
      patients: [], // Data pasien
      patientForm: {
        id: null,
        name: "",
        date_of_birth: "",
        gender: "male",
        address: "",
        phone: "",
        email: "",
      },
    };
  },
  methods: {
    async fetchPatients() {
      try {
        const response = await fetch("http://127.0.0.1:8000/api/patients");
        const data = await response.json();
        if (data.success) {
          this.patients = data.data;
        } else {
          console.error("Failed to fetch patients:", data.message);
        }
      } catch (error) {
        console.error("Error fetching patients:", error);
      }
    },

    async savePatient() {
      const method = this.patientForm.id ? "PUT" : "POST";
      const url = this.patientForm.id
        ? `http://127.0.0.1:8000/api/patients/${this.patientForm.id}`
        : "http://127.0.0.1:8000/api/patients";

      try {
        const response = await fetch(url, {
          method: method,
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(this.patientForm),
        });

        const data = await response.json();
        if (data.success) {
          alert(
            `Patient ${this.patientForm.id ? "updated" : "created"} successfully!`
          );
          this.fetchPatients();
          this.resetForm();
        } else {
          alert(`Failed to ${this.patientForm.id ? "update" : "create"} patient.`);
        }
      } catch (error) {
        console.error("Error saving patient:", error);
        alert("An error occurred. Please try again.");
      }
    },

    editPatient(patient) {
      this.patientForm = { ...patient };
    },

    async deletePatient(id) {
      if (confirm("Are you sure you want to delete this patient?")) {
        try {
          const response = await fetch(
            `http://127.0.0.1:8000/api/patients/${id}`,
            { method: "DELETE" }
          );
          const result = await response.json();
          if (result.success) {
            this.fetchPatients();
          } else {
            console.error("Error deleting patient:", result.message);
          }
        } catch (error) {
          console.error("Error deleting patient:", error);
        }
      }
    },

    resetForm() {
      this.patientForm = {
        id: null,
        name: "",
        date_of_birth: "",
        gender: "male",
        address: "",
        phone: "",
        email: "",
      };
    },
  },
  mounted() {
    this.fetchPatients();
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
