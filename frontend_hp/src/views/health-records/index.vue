<template>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Health Records Form</h2>

    <!-- Form untuk Create/Update Health Record -->
    <form @submit.prevent="saveHealthRecord">
      <div class="form-group">
        <label for="patient-name">Patient</label>
        <select
          id="patient-name"
          class="form-control"
          v-model="healthRecordForm.patient_id"
          required
        >
          <option value="" disabled>Select Patient</option>
          <option v-for="patient in patients" :key="patient.id" :value="patient.id">
            {{ patient.name }}
          </option>
        </select>
      </div>

      <!-- Medical History -->
      <div class="form-group">
        <label for="medical-history">Medical History</label>
        <textarea
          id="medical-history"
          class="form-control"
          v-model="healthRecordForm.medical_history"
          rows="3"
          placeholder="Enter medical history"
          required
        ></textarea>
      </div>

      <!-- Lab Results -->
      <div class="form-group">
        <label for="lab-results">Lab Results</label>
        <textarea
          id="lab-results"
          class="form-control"
          v-model="healthRecordForm.lab_results"
          rows="3"
          placeholder="Enter lab results"
          required
        ></textarea>
      </div>

      <!-- Vaccination -->
      <div class="form-group">
        <label for="vaccination">Vaccination</label>
        <textarea
          id="vaccination"
          class="form-control"
          v-model="healthRecordForm.vaccination"
          rows="3"
          placeholder="Enter vaccination details"
        ></textarea>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary">
        {{ healthRecordForm.id ? "Update Health Record" : "Save Health Record" }}
      </button>
      <button
        type="button"
        class="btn btn-secondary ml-2"
        v-if="healthRecordForm.id"
        @click="resetForm"
      >
        Cancel
      </button>
    </form>

    <hr class="my-5" />

    <!-- Tabel Health Record List -->
    <h3 class="text-center">Health Record List</h3>
    <div class="table-responsive">
      <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th>Patient</th>
            <th>Medical History</th>
            <th>Lab Results</th>
            <th>Vaccination</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="healthRecord in healthRecordList" :key="healthRecord.id">
            <td>{{ healthRecord.patient.name }}</td>
            <td>{{ healthRecord.medical_history }}</td>
            <td>{{ healthRecord.lab_results }}</td>
            <td>{{ healthRecord.vaccination }}</td>
            <td>
              <button
                class="btn btn-warning btn-sm"
                @click="editHealthRecord(healthRecord)"
              >
                Edit
              </button>
              <button
                class="btn btn-danger btn-sm"
                @click="deleteHealthRecord(healthRecord.id)"
              >
                Delete
              </button>
            </td>
          </tr>
          <tr v-if="healthRecordList.length === 0">
            <td colspan="5" class="text-center">No health records available</td>
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
      healthRecordList: [],
      healthRecordForm: {
        id: null,
        patient_id: "",
        medical_history: "",
        lab_results: "",
        vaccination: "",
      },
      patients: [],
    };
  },
  methods: {
    // Fetch data for health records
    async fetchHealthRecords() {
      try {
        const response = await fetch("http://127.0.0.1:8000/api/health-records");
        const data = await response.json();
        if (data.success) {
          this.healthRecordList = data.data;
        } else {
          console.error("Failed to fetch health records:", data.message);
        }
      } catch (error) {
        console.error("Error fetching health records:", error);
      }
    },

    // Fetch list of patients
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

    // Save or update health record
    async saveHealthRecord() {
      const method = this.healthRecordForm.id ? "PUT" : "POST";
      const url = this.healthRecordForm.id
        ? `http://127.0.0.1:8000/api/health-records/${this.healthRecordForm.id}`
        : "http://127.0.0.1:8000/api/health-records";

      try {
        const response = await fetch(url, {
          method: method,
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(this.healthRecordForm),
        });

        const data = await response.json();
        if (data.success) {
          alert(
            `Health Record ${
              this.healthRecordForm.id ? "updated" : "created"
            } successfully!`
          );
          this.fetchHealthRecords();
          this.resetForm();
        } else {
          alert(`Failed to ${this.healthRecordForm.id ? "update" : "create"} health record.`);
        }
      } catch (error) {
        console.error("Error saving health record:", error);
        alert("An error occurred. Please try again.");
      }
    },

    // Edit health record
    editHealthRecord(healthRecord) {
      this.healthRecordForm = { ...healthRecord };
    },

    // Delete health record
    async deleteHealthRecord(id) {
      if (confirm("Are you sure you want to delete this health record?")) {
        try {
          const response = await fetch(
            `http://127.0.0.1:8000/api/health-records/${id}`,
            { method: "DELETE" }
          );
          const result = await response.json();
          if (result.success) {
            this.fetchHealthRecords();
          } else {
            console.error("Error deleting health record:", result.message);
          }
        } catch (error) {
          console.error("Error deleting health record:", error);
        }
      }
    },

    // Reset form
    resetForm() {
      this.healthRecordForm = {
        id: null,
        patient_id: "",
        medical_history: "",
        lab_results: "",
        vaccination: "",
      };
    },
  },
  mounted() {
    this.fetchHealthRecords(); // Fetch health records data when component is mounted
    this.fetchPatients(); // Fetch patient list
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
