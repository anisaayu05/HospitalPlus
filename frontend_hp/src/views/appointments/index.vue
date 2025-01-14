<template>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Appointment Scheduling</h2>

    <!-- Form untuk Create/Update Appointment -->
    <form @submit.prevent="saveAppointment">
      <div class="form-group">
        <label for="patient-name">Patient</label>
        <select
          id="patient-name"
          class="form-control"
          v-model="appointmentForm.patient_id"
          required
        >
          <option value="" disabled>Select Patient</option>
          <option v-for="patient in patients" :key="patient.id" :value="patient.id">
            {{ patient.name }}
          </option>
        </select>
      </div>

      <div class="form-group">
        <label for="doctor-name">Doctor</label>
        <select
          id="doctor-name"
          class="form-control"
          v-model="appointmentForm.doctor_id"
          required
        >
          <option value="" disabled>Select Doctor</option>
          <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">
            {{ doctor.name }}
          </option>
        </select>
      </div>

      <div class="form-group">
        <label for="appointment-date">Appointment Date</label>
        <input
          type="datetime-local"
          id="appointment-date"
          class="form-control"
          v-model="appointmentForm.appointment_date"
          required
        />
      </div>

      <div class="form-group">
        <label for="status">Status</label>
        <select
          id="status"
          class="form-control"
          v-model="appointmentForm.status"
          required
        >
          <option value="pending">Pending</option>
          <option value="completed">Completed</option>
          <option value="canceled">Canceled</option>
        </select>
      </div>

      <div class="form-group">
        <label for="notes">Notes</label>
        <textarea
          id="notes"
          class="form-control"
          v-model="appointmentForm.notes"
          rows="3"
          placeholder="Enter any additional notes (optional)"
        ></textarea>
      </div>

      <button type="submit" class="btn btn-primary">
        {{ appointmentForm.id ? "Update Appointment" : "Save Appointment" }}
      </button>
      <button
        type="button"
        class="btn btn-secondary ml-2"
        v-if="appointmentForm.id"
        @click="resetForm"
      >
        Cancel
      </button>
    </form>

    <hr class="my-5" />

    <!-- Tabel Appointment List -->
    <h3 class="text-center">Appointment List</h3>
    <div class="table-responsive">
      <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Appointment Date</th>
            <th>Status</th>
            <th>Notes</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="appointment in appointments" :key="appointment.id">
            <td>{{ appointment.patient.name }}</td>
            <td>{{ appointment.doctor.name }}</td>
            <td>{{ new Date(appointment.appointment_date).toLocaleString() }}</td>
            <td>{{ appointment.status }}</td>
            <td>{{ appointment.notes || "No Notes" }}</td>
            <td>
              <button
                class="btn btn-warning btn-sm"
                @click="editAppointment(appointment)"
              >
                Edit
              </button>
              <button
                class="btn btn-danger btn-sm"
                @click="deleteAppointment(appointment.id)"
              >
                Delete
              </button>
            </td>
          </tr>
          <tr v-if="appointments.length === 0">
            <td colspan="6" class="text-center">No appointments available</td>
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
      appointments: [], // Data appointments
      appointmentForm: {
        id: null,
        patient_id: "",
        doctor_id: "",
        appointment_date: "",
        status: "pending",
        notes: "",
      },
      patients: [], // Daftar pasien dari API
      doctors: [], // Daftar dokter dari API
    };
  },
  methods: {
    // Fetch data appointments
    async fetchAppointments() {
      try {
        const response = await fetch("http://127.0.0.1:8000/api/appointments");
        const data = await response.json();
        if (data.success) {
          this.appointments = data.data;
        } else {
          console.error("Failed to fetch appointments:", data.message);
        }
      } catch (error) {
        console.error("Error fetching appointments:", error);
      }
    },

    // Fetch data pasien dan dokter
    async fetchPatientsAndDoctors() {
      try {
        const [patientsResponse, doctorsResponse] = await Promise.all([
          fetch("http://127.0.0.1:8000/api/patients"),
          fetch("http://127.0.0.1:8000/api/doctors"),
        ]);

        const patientsData = await patientsResponse.json();
        const doctorsData = await doctorsResponse.json();

        if (patientsData.success) {
          this.patients = patientsData.data;
        }
        if (doctorsData.success) {
          this.doctors = doctorsData.data;
        }
      } catch (error) {
        console.error("Error fetching patients or doctors:", error);
      }
    },

    // Save or update appointment
    async saveAppointment() {
      const method = this.appointmentForm.id ? "PUT" : "POST";
      const url = this.appointmentForm.id
        ? `http://127.0.0.1:8000/api/appointments/${this.appointmentForm.id}`
        : "http://127.0.0.1:8000/api/appointments";

      try {
        const response = await fetch(url, {
          method: method,
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(this.appointmentForm),
        });

        const data = await response.json();
        if (data.success) {
          alert(
            `Appointment ${
              this.appointmentForm.id ? "updated" : "created"
            } successfully!`
          );
          this.fetchAppointments();
          this.resetForm();
        } else {
          alert(`Failed to ${this.appointmentForm.id ? "update" : "create"} appointment.`);
        }
      } catch (error) {
        console.error("Error saving appointment:", error);
        alert("An error occurred. Please try again.");
      }
    },

    // Edit appointment
    editAppointment(appointment) {
      this.appointmentForm = { ...appointment };
    },

    // Delete appointment
    async deleteAppointment(id) {
      if (confirm("Are you sure you want to delete this appointment?")) {
        try {
          const response = await fetch(
            `http://127.0.0.1:8000/api/appointments/${id}`,
            { method: "DELETE" }
          );
          const result = await response.json();
          if (result.success) {
            this.fetchAppointments();
          } else {
            console.error("Error deleting appointment:", result.message);
          }
        } catch (error) {
          console.error("Error deleting appointment:", error);
        }
      }
    },

    // Reset form
    resetForm() {
      this.appointmentForm = {
        id: null,
        patient_id: "",
        doctor_id: "",
        appointment_date: "",
        status: "pending",
        notes: "",
      };
    },
  },
  mounted() {
    this.fetchAppointments(); // Fetch data saat komponen di-mount
    this.fetchPatientsAndDoctors(); // Fetch data pasien dan dokter
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
