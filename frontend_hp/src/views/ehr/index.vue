<template>
    <div class="container mt-5">
      <h2 class="text-center mb-4">Electronic Health Record (EHR) Form</h2>
  
      <!-- Form untuk Create/Update EHR -->
      <form @submit.prevent="saveEHR">
        <div class="form-group">
          <label for="patient-name">Patient</label>
          <select
            id="patient-name"
            class="form-control"
            v-model="ehrForm.patient_id"
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
            v-model="ehrForm.medical_history"
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
            v-model="ehrForm.lab_results"
            rows="3"
            placeholder="Enter lab results (optional)"
          ></textarea>
        </div>
  
        <!-- Vaccination Status -->
        <div class="form-group">
          <label for="vaccination-status">Vaccination Status</label>
          <textarea
            id="vaccination-status"
            class="form-control"
            v-model="ehrForm.vaccination_status"
            rows="3"
            placeholder="Enter vaccination status (optional)"
          ></textarea>
        </div>
  
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">
          {{ ehrForm.id ? "Update EHR" : "Save EHR" }}
        </button>
        <button
          type="button"
          class="btn btn-secondary ml-2"
          v-if="ehrForm.id"
          @click="resetForm"
        >
          Cancel
        </button>
      </form>
  
      <hr class="my-5" />
  
      <!-- Tabel EHR List -->
      <h3 class="text-center">EHR List</h3>
      <div class="table-responsive">
        <table class="table table-dark table-striped">
          <thead>
            <tr>
              <th>Patient</th>
              <th>Medical History</th>
              <th>Lab Results</th>
              <th>Vaccination Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="ehr in ehrList" :key="ehr.id">
              <td>{{ ehr.patient.name }}</td>
              <td>{{ ehr.medical_history }}</td>
              <td>{{ ehr.lab_results || "No Lab Results" }}</td>
              <td>{{ ehr.vaccination_status || "No Vaccination Status" }}</td>
              <td>
                <button
                  class="btn btn-warning btn-sm"
                  @click="editEHR(ehr)"
                >
                  Edit
                </button>
                <button
                  class="btn btn-danger btn-sm"
                  @click="deleteEHR(ehr.id)"
                >
                  Delete
                </button>
              </td>
            </tr>
            <tr v-if="ehrList.length === 0">
              <td colspan="5" class="text-center">No EHR records available</td>
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
        ehrList: [], // Data for EHR records
        ehrForm: {
          id: null,
          patient_id: "",
          medical_history: "",
          lab_results: "",
          vaccination_status: "",
        },
        patients: [], // List of patients from API
      };
    },
    methods: {
      // Fetch data for EHR records
      async fetchEHR() {
        try {
          const response = await fetch("http://127.0.0.1:8000/api/ehr");
          const data = await response.json();
          if (data.success) {
            this.ehrList = data.data;
          } else {
            console.error("Failed to fetch EHR records:", data.message);
          }
        } catch (error) {
          console.error("Error fetching EHR records:", error);
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
  
      // Save or update EHR record
      async saveEHR() {
        const method = this.ehrForm.id ? "PUT" : "POST";
        const url = this.ehrForm.id
          ? `http://127.0.0.1:8000/api/ehr/${this.ehrForm.id}`
          : "http://127.0.0.1:8000/api/ehr";
  
        try {
          const response = await fetch(url, {
            method: method,
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(this.ehrForm),
          });
  
          const data = await response.json();
          if (data.success) {
            alert(
              `EHR ${this.ehrForm.id ? "updated" : "created"} successfully!`
            );
            this.fetchEHR();
            this.resetForm();
          } else {
            alert(`Failed to ${this.ehrForm.id ? "update" : "create"} EHR.`);
          }
        } catch (error) {
          console.error("Error saving EHR record:", error);
          alert("An error occurred. Please try again.");
        }
      },
  
      // Edit EHR record
      editEHR(ehr) {
        this.ehrForm = { ...ehr };
      },
  
      // Delete EHR record
      async deleteEHR(id) {
        if (confirm("Are you sure you want to delete this EHR record?")) {
          try {
            const response = await fetch(
              `http://127.0.0.1:8000/api/ehr/${id}`,
              { method: "DELETE" }
            );
            const result = await response.json();
            if (result.success) {
              this.fetchEHR();
            } else {
              console.error("Error deleting EHR record:", result.message);
            }
          } catch (error) {
            console.error("Error deleting EHR record:", error);
          }
        }
      },
  
      // Reset form
      resetForm() {
        this.ehrForm = {
          id: null,
          patient_id: "",
          medical_history: "",
          lab_results: "",
          vaccination_status: "",
        };
      },
    },
    mounted() {
      this.fetchEHR(); // Fetch EHR data when component is mounted
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
  