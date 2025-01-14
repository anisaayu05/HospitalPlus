<script>
import api from "../../api"; // Pastikan path API sesuai

export default {
  data() {
    return {
      ehr: {
        patient_id: null,
        medical_history: "",
        lab_results: "",
        vaccination_status: "",
        diagnosis: "",
        treatment: "",
        notes: "",
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
    async saveEHR() {
      try {
        const response = await api.post("/api/ehrs", this.ehr);

        if (response.data.success) {
          alert("EHR has been created!");
          this.resetForm();
          this.$router.push("/ehrs");
        } else {
          alert("Failed to create EHR.");
        }
      } catch (error) {
        console.error("Error saving EHR:", error);
        this.errors = error.response?.data?.errors || {};
        alert("Failed to create EHR.");
      }
    },
    resetForm() {
      this.ehr = {
        patient_id: null,
        medical_history: "",
        lab_results: "",
        vaccination_status: "",
        diagnosis: "",
        treatment: "",
        notes: "",
      };
      this.errors = {};
    },
  },
};
</script>

<template>
  <div class="container mt-5">
    <h2 class="text-center">Create EHR</h2>

    <form @submit.prevent="saveEHR">
      <div class="form-group">
        <label for="patient_id">Patient</label>
        <select
          id="patient_id"
          v-model="ehr.patient_id"
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
          v-model="ehr.medical_history"
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
          v-model="ehr.lab_results"
          class="form-control"
          rows="3"
          placeholder="Enter lab results"
        ></textarea>
        <small v-if="errors.lab_results" class="text-danger">{{ errors.lab_results[0] }}</small>
      </div>

      <div class="form-group">
        <label for="vaccination_status">Vaccination Status</label>
        <input
          type="text"
          id="vaccination_status"
          v-model="ehr.vaccination_status"
          class="form-control"
          placeholder="Enter vaccination status"
        />
        <small v-if="errors.vaccination_status" class="text-danger">{{ errors.vaccination_status[0] }}</small>
      </div>

      <div class="form-group">
        <label for="diagnosis">Diagnosis</label>
        <textarea
          id="diagnosis"
          v-model="ehr.diagnosis"
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
          v-model="ehr.treatment"
          class="form-control"
          rows="3"
          placeholder="Enter treatment details"
        ></textarea>
        <small v-if="errors.treatment" class="text-danger">{{ errors.treatment[0] }}</small>
      </div>

      <div class="form-group">
        <label for="notes">Notes</label>
        <textarea
          id="notes"
          v-model="ehr.notes"
          class="form-control"
          rows="3"
          placeholder="Enter additional notes (optional)"
        ></textarea>
        <small v-if="errors.notes" class="text-danger">{{ errors.notes[0] }}</small>
      </div>

      <button type="submit" class="btn btn-primary btn-block">Create EHR</button>
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
