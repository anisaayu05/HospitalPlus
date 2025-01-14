<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import api from '../../api';

// State untuk form
const patient_id = ref('');
const doctor_id = ref('');
const appointment_date = ref('');
const status = ref('');
const notes = ref('');
const errors = ref({}); // Untuk menyimpan error dari API

const patients = ref([]);
const doctors = ref([]);

// Mendapatkan parameter ID dari route
const route = useRoute();
const router = useRouter();
const appointmentId = route.params.id;

// Fungsi untuk mengambil data appointment berdasarkan ID
const fetchAppointments = async () => {
  try {
    const response = await api.get(`/api/appointments/${appointmentId}`);
    const appointment = response.data.data;

    // Assign data dari API ke variabel reaktif
    patient_id.value = appointment.patient_id;
    doctor_id.value = appointment.doctor_id;
    appointment_date.value = appointment.appointment_date;
    status.value = appointment.status;
    notes.value = appointment.notes;
  } catch (error) {
    console.error('Error fetching appointment:', error);
    alert('Failed to fetch appointment data.');
  }
};

// Fungsi untuk mengambil daftar pasien dan dokter
const fetchPatientsAndDoctors = async () => {
  try {
    const [patientsResponse, doctorsResponse] = await Promise.all([
      api.get('/api/patients'),
      api.get('/api/doctors'),
    ]);

    patients.value = patientsResponse.data.data;
    doctors.value = doctorsResponse.data.data;
  } catch (error) {
    console.error('Error fetching patients or doctors:', error);
    alert('Failed to fetch patients or doctors.');
  }
};

// Fungsi untuk submit form
const submitForm = async () => {
  try {
    await api.put(`/api/appointments/${appointmentId}`, {
      patient_id: patient_id.value,
      doctor_id: doctor_id.value,
      appointment_date: appointment_date.value,
      status: status.value,
      notes: notes.value,
    });

    alert('Appointment updated successfully!');
    router.push('/appointments'); // Redirect menggunakan Vue Router
  } catch (error) {
    console.error('Error updating appointment:', error);

    // Tampilkan error dari API (jika ada)
    if (error.response && error.response.data && error.response.data.errors) {
      errors.value = error.response.data.errors;
    } else {
      alert('Failed to update appointment.');
    }
  }
};

// Mengambil data appointment saat komponen dimuat
onMounted(() => {
  fetchAppointments();
  fetchPatientsAndDoctors();
});
</script>

<template>
  <div class="container mt-5">
    <h2 class="text-center">Edit Appointment</h2>

    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="patient_id">Patient</label>
        <select
          id="patient_id"
          v-model="patient_id"
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
        <label for="doctor_id">Doctor</label>
        <select
          id="doctor_id"
          v-model="doctor_id"
          class="form-control"
          required
        >
          <option value="" disabled>Select Doctor</option>
          <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">
            {{ doctor.name }}
          </option>
        </select>
        <small v-if="errors.doctor_id" class="text-danger">{{ errors.doctor_id[0] }}</small>
      </div>

      <div class="form-group">
        <label for="appointment_date">Appointment Date</label>
        <input
          type="datetime-local"
          id="appointment_date"
          v-model="appointment_date"
          class="form-control"
          required
        />
        <small v-if="errors.appointment_date" class="text-danger">{{ errors.appointment_date[0] }}</small>
      </div>

      <div class="form-group">
        <label for="status">Status</label>
        <select id="status" v-model="status" class="form-control" required>
          <option value="pending">Pending</option>
          <option value="completed">Completed</option>
          <option value="canceled">Canceled</option>
        </select>
        <small v-if="errors.status" class="text-danger">{{ errors.status[0] }}</small>
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

      <button type="submit" class="btn btn-primary btn-block">Update Appointment</button>
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
