<script>
import api from "../../api"; // Pastikan path API sesuai

export default {
  data() {
    return {
      appointment: {
        patient_id: null, // ID pasien
        doctor_id: null,  // ID dokter
        appointment_date: "",
        status: "pending",
        notes: "",
      },
      patients: [], // Daftar pasien dari DB
      doctors: [],  // Daftar dokter dari DB
      errors: {},
    };
  },
  async mounted() {
    // Ambil data pasien dan dokter dari API saat halaman dimuat
    await this.fetchPatients();
    await this.fetchDoctors();
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
    async fetchDoctors() {
      try {
        const response = await api.get("/api/doctors");
        this.doctors = response.data.data;
      } catch (error) {
        console.error("Error fetching doctors:", error);
        alert("Failed to fetch doctors.");
      }
    },
    async saveAppointment() {
      try {
        const response = await api.post("/api/appointments", this.appointment);

        if (response.data.success) {
          alert("Appointment has been saved!");
          this.resetForm();
          this.$router.push("/appointments");
        } else {
          alert("Failed to save Appointment.");
        }
      } catch (error) {
        console.error("Error saving Appointment:", error);
        this.errors = error.response?.data?.errors || {};
        alert("Failed to save Appointment.");
      }
    },
    resetForm() {
      this.appointment = {
        patient_id: null,
        doctor_id: null,
        appointment_date: "",
        status: "pending",
        notes: "",
      };
      this.errors = {};
    },
  },
};
</script>

<template>
  <div class="container mt-5">
    <h2 class="text-center">Create Appointment</h2>

    <form @submit.prevent="saveAppointment">
      <div class="form-group">
        <label for="patient_id">Patient</label>
        <select
          id="patient_id"
          v-model="appointment.patient_id"
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
          v-model="appointment.doctor_id"
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
          v-model="appointment.appointment_date"
          class="form-control"
          required
        />
        <small v-if="errors.appointment_date" class="text-danger">{{ errors.appointment_date[0] }}</small>
      </div>

      <div class="form-group">
        <label for="status">Status</label>
        <select id="status" v-model="appointment.status" class="form-control" required>
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
          v-model="appointment.notes"
          class="form-control"
          rows="3"
          placeholder="Enter additional notes (optional)"
        ></textarea>
        <small v-if="errors.notes" class="text-danger">{{ errors.notes[0] }}</small>
      </div>

      <button type="submit" class="btn btn-primary btn-block">Create Appointment</button>
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
