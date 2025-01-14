<script setup>
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import api from '../../api';

// State untuk form
const patient_id = ref('');
const medical_history = ref('');
const diagnosis = ref('');
const medical_procedures = ref('');
const medications = ref('');
const allergies = ref('');
const notes = ref('');
const errors = ref({}); // Untuk menyimpan error dari API

const patients = ref([]);

// Mendapatkan parameter ID dari route
const route = useRoute();
const router = useRouter();
const recordId = route.params.id;

// Fungsi untuk mengambil data medical record berdasarkan ID
const fetchMedicalRecord = async () => {
  try {
    const response = await api.get(`/api/health-records/${recordId}`);
    const record = response.data.data;

    // Assign data dari API ke variabel reaktif
    patient_id.value = record.patient_id;
    medical_history.value = record.medical_history;
    diagnosis.value = record.diagnosis;
    medical_procedures.value = record.medical_procedures;
    medications.value = record.medications;
    allergies.value = record.allergies;
    notes.value = record.notes;
  } catch (error) {
    console.error('Error fetching medical record:', error);
    alert('Failed to fetch medical record data.');
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
    await api.put(`/api/health-records/${recordId}`, {
      patient_id: patient_id.value,
      medical_history: medical_history.value,
      diagnosis: diagnosis.value,
      medical_procedures: medical_procedures.value,
      medications: medications.value,
      allergies: allergies.value,
      notes: notes.value,
    });

    alert('Medical record updated successfully!');
    router.push('/health-records'); // Redirect menggunakan Vue Router
  } catch (error) {
    console.error('Error updating medical record:', error);

    // Tampilkan error dari API (jika ada)
    if (error.response && error.response.data && error.response.data.errors) {
      errors.value = error.response.data.errors;
    } else {
      alert('Failed to update medical record.');
    }
  }
};

// Mengambil data medical record saat komponen dimuat
onMounted(() => {
  fetchMedicalRecord();
  fetchPatients();
});
</script>

<template>
  <div class="container mt-5">
    <h2 class="text-center">Edit Health Record</h2>

    <form @submit.prevent="submitForm">
      <!-- Patient Selection -->
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

      <!-- Medical History -->
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

      <!-- Diagnosis -->
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

      <!-- Medical Procedures -->
      <div class="form-group">
        <label for="medical_procedures">Medical Procedures</label>
        <textarea
          id="medical_procedures"
          v-model="medical_procedures"
          class="form-control"
          rows="3"
          placeholder="Enter medical procedures"
        ></textarea>
        <small v-if="errors.medical_procedures" class="text-danger">{{ errors.medical_procedures[0] }}</small>
      </div>

      <!-- Medications -->
      <div class="form-group">
        <label for="medications">Medications</label>
        <textarea
          id="medications"
          v-model="medications"
          class="form-control"
          rows="3"
          placeholder="Enter medications"
        ></textarea>
        <small v-if="errors.medications" class="text-danger">{{ errors.medications[0] }}</small>
      </div>

      <!-- Allergies -->
      <div class="form-group">
        <label for="allergies">Allergies</label>
        <textarea
          id="allergies"
          v-model="allergies"
          class="form-control"
          rows="3"
          placeholder="Enter allergies"
        ></textarea>
        <small v-if="errors.allergies" class="text-danger">{{ errors.allergies[0] }}</small>
      </div>

      <!-- Notes -->
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

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary btn-block">Update Health Record</button>
    </form>
  </div>
</template>

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
