<template>
  <div class="container mt-5">
    <h2 class="text-center">Create Health Record</h2>

    <!-- Form untuk membuat Health Record -->
    <form @submit.prevent="saveHealthRecord">
      <div class="form-group">
        <label for="patient_id">Patient</label>
        <select
          id="patient_id"
          v-model="record.patient_id"
          class="form-control"
          required
        >
          <option value="" disabled>Select Patient</option>
          <option v-for="patient in patients" :key="patient.id" :value="patient.id">
            {{ patient.name }}
          </option>
        </select>
        <small v-if="errors.patient_id" class="text-danger">{{ errors.patient_id[0] }}</small>
      </div>

      <div class="form-group">
        <label for="medical_history">Medical History</label>
        <textarea
          id="medical_history"
          v-model="record.medical_history"
          class="form-control"
          rows="3"
          placeholder="Enter medical history"
        ></textarea>
        <small v-if="errors.medical_history" class="text-danger">{{ errors.medical_history[0] }}</small>
      </div>

      <div class="form-group">
        <label for="lab_results">Lab Results</label>
        <textarea
          id="lab_results"
          v-model="record.lab_results"
          class="form-control"
          rows="3"
          placeholder="Enter lab results"
        ></textarea>
        <small v-if="errors.lab_results" class="text-danger">{{ errors.lab_results[0] }}</small>
      </div>

      <div class="form-group">
        <label for="vaccination">Vaccination</label>
        <textarea
          id="vaccination"
          v-model="record.vaccination"
          class="form-control"
          rows="3"
          placeholder="Enter vaccination history"
        ></textarea>
        <small v-if="errors.vaccination" class="text-danger">{{ errors.vaccination[0] }}</small>
      </div>

      <button type="submit" class="btn btn-primary btn-block">Create Health Record</button>
    </form>
  </div>
</template>

<script>
import api from "../../api"; // Pastikan path API sesuai

export default {
  data() {
    return {
      record: {
        patient_id: null,
        medical_history: "", // Menyesuaikan dengan kolom di model
        lab_results: "",      // Menyesuaikan dengan kolom di model
        vaccination: "",      // Menyesuaikan dengan kolom di model
      },
      patients: [], // Daftar pasien dari DB
      errors: {},  // Untuk menyimpan pesan error
    };
  },
  async mounted() {
    // Ambil data pasien dari API saat halaman dimuat
    await this.fetchPatients();
  },
  methods: {
    async fetchPatients() {
      try {
        const response = await api.get("/api/patients"); // Sesuaikan dengan endpoint yang benar
        this.patients = response.data.data;
      } catch (error) {
        console.error("Error fetching patients:", error);
        alert("Failed to fetch patients.");
      }
    },
    async saveHealthRecord() {
      try {
        // Sesuaikan endpoint API sesuai dengan resource HealthRecord yang sudah ada
        const response = await api.post("/api/health-records", this.record);

        if (response.data.success) {
          alert("Health record has been created!");
          this.resetForm();
          this.$router.push("/health-records"); // Ubah sesuai route yang ada
        } else {
          alert("Failed to create health record.");
        }
      } catch (error) {
        console.error("Error saving health record:", error);
        this.errors = error.response?.data?.errors || {}; // Menangani validasi error
        alert("Failed to create health record.");
      }
    },
    resetForm() {
      this.record = {
        patient_id: null,
        medical_history: "",
        lab_results: "",
        vaccination: "",
      };
      this.errors = {}; // Reset errors
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
  background-color: #1c1c1c;
  color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}
label {
  font-weight: bold;
}
button {
  background-color: #007bff;
  color: white;
}
.text-danger {
  font-size: 0.875rem;
}
</style>
