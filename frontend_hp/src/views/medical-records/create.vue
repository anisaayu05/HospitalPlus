<script>
import api from "../../api"; // Pastikan path API sesuai

export default {
  data() {
    return {
      record: {
        patient_id: null,
        diagnosis: "",
        treatment: "",
      },
      patients: [], // Daftar pasien dari DB
      errors: {},
    };
  },
  async mounted() {
    // Ambil data pasien dari API saat halaman dimuat
    await this.fetchPatients();
  },
  methods: {
    async fetchPatients() {
      try {
        const response = await api.get("/api/patients");
        this.patients = response.data.data;
      } catch (error) {
        console.error("Error fetching patients:", error);
        alert("Failed to fetch patients.");
      }
    },
    async saveMedicalRecord() {
      try {
        const response = await api.post("/api/medicals", this.record);

        if (response.data.success) {
          alert("Medical record has been created!");
          this.resetForm();
          this.$router.push("/medicals");
        } else {
          alert("Failed to create medical record.");
        }
      } catch (error) {
        console.error("Error saving medical record:", error);
        this.errors = error.response?.data?.errors || {};
        alert("Failed to create medical record.");
      }
    },
    resetForm() {
      this.record = {
        patient_id: null,
        diagnosis: "",
        treatment: "",
      };
      this.errors = {};
    },
  },
};
</script>

<template>
  <div class="container mt-5">
    <h2 class="text-center">Create Medical Record</h2>

    <form @submit.prevent="saveMedicalRecord">
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
        <label for="diagnosis">Diagnosis</label>
        <textarea
          id="diagnosis"
          v-model="record.diagnosis"
          class="form-control"
          rows="3"
          placeholder="Enter diagnosis"
        ></textarea>
        <small v-if="errors.diagnosis" class="text-danger">{{ errors.diagnosis[0] }}</small>
      </div>

      <div class="form-group">
        <label for="treatment">Treatment</label>
        <textarea
          id="treatment"
          v-model="record.treatment"
          class="form-control"
          rows="3"
          placeholder="Enter treatment details"
        ></textarea>
        <small v-if="errors.treatment" class="text-danger">{{ errors.treatment[0] }}</small>
      </div>

      <button type="submit" class="btn btn-primary btn-block">Create Medical Record</button>
    </form>
  </div>
</template>

<style>
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
