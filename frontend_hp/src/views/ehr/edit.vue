<script setup>
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import api from '../../api';

// State untuk form
const patient_id = ref('');
const medical_history = ref('');
const lab_results = ref('');
const vaccination_status = ref('');
const diagnosis = ref('');
const treatment = ref('');
const notes = ref('');
const errors = ref({}); // Untuk menyimpan error dari API

const patients = ref([]);

// Mendapatkan parameter ID dari route
const route = useRoute();
const router = useRouter();
const recordId = route.params.id;

// Fungsi untuk mengambil data EHR berdasarkan ID
const fetchEHR = async () => {
  try {
    const response = await api.get(`/api/ehrs/${recordId}`);
    const ehr = response.data.data;

    // Assign data dari API ke variabel reaktif
    patient_id.value = ehr.patient_id;
    medical_history.value = ehr.medical_history;
    lab_results.value = ehr.lab_results;
    vaccination_status.value = ehr.vaccination_status;
    diagnosis.value = ehr.diagnosis;
    treatment.value = ehr.treatment;
    notes.value = ehr.notes;
  } catch (error) {
    console.error('Error fetching EHR:', error);
    alert('Failed to fetch EHR data.');
  }
};

// Fungsi untuk mengambil daftar pasien
const fetchPatients = async () => {
  try {
    const response = await api.get('/api/patients');
    patients.value = response.data.data;
  } catch (error) {
    console.error('Error fetching patients:', error);
    alert('Failed to fetch patients.');
  }
};

// Fungsi untuk submit form
const submitForm = async () => {
  try {
    await api.put(`/api/ehrs/${recordId}`, {
      patient_id: patient_id.value,
      medical_history: medical_history.value,
      lab_results: lab_results.value,
      vaccination_status: vaccination_status.value,
      diagnosis: diagnosis.value,
      treatment: treatment.value,
      notes: notes.value,
    });

    alert('EHR updated successfully!');
    router.push('/ehrs'); // Redirect menggunakan Vue Router
  } catch (error) {
    console.error('Error updating EHR:', error);

    // Tampilkan error dari API (jika ada)
    if (error.response && error.response.data && error.response.data.errors) {
      errors.value = error.response.data.errors;
    } else {
      alert('Failed to update EHR.');
    }
  }
};

// Mengambil data EHR saat komponen dimuat
onMounted(() => {
  fetchEHR();
  fetchPatients();
});
</script>

<template>
  <div class="container mt-5">
    <h2 class="text-center">Edit EHR</h2>

    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="patient_id">Patient</label>
        <select id="patient_id" v-model="patient_id" class="form-control" required>
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
          v-model="medical_history"
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
          v-model="lab_results"
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
          v-model="vaccination_status"
          class="form-control"
          placeholder="Enter vaccination status"
        />
        <small v-if="errors.vaccination_status" class="text-danger">{{ errors.vaccination_status[0] }}</small>
      </div>

      <div class="form-group">
        <label for="diagnosis">Diagnosis</label>
        <textarea
          id="diagnosis"
          v-model="diagnosis"
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
          v-model="treatment"
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
          v-model="notes"
          class="form-control"
          rows="3"
          placeholder="Enter additional notes (optional)"
        ></textarea>
        <small v-if="errors.notes" class="text-danger">{{ errors.notes[0] }}</small>
      </div>

      <button type="submit" class="btn btn-primary btn-block">Update EHR</button>
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
