<template>
    <div class="container mt-5">
      <h2 class="text-center mb-4">Medical Records Form</h2>
  
      <!-- Form untuk Create/Update Medical Record -->
      <form @submit.prevent="saveMedicalRecord">
        <div class="form-group">
          <label for="patient-name">Patient</label>
          <select
            id="patient-name"
            class="form-control"
            v-model="medicalRecordForm.patient_id"
            required
          >
            <option value="" disabled>Select Patient</option>
            <option v-for="patient in patients" :key="patient.id" :value="patient.id">
              {{ patient.name }}
            </option>
          </select>
        </div>
  
        <!-- Diagnosis -->
        <div class="form-group">
          <label for="diagnosis">Diagnosis</label>
          <textarea
            id="diagnosis"
            class="form-control"
            v-model="medicalRecordForm.diagnosis"
            rows="3"
            placeholder="Enter diagnosis"
            required
          ></textarea>
        </div>
  
        <!-- Treatment -->
        <div class="form-group">
          <label for="treatment">Treatment</label>
          <textarea
            id="treatment"
            class="form-control"
            v-model="medicalRecordForm.treatment"
            rows="3"
            placeholder="Enter treatment plan"
            required
          ></textarea>
        </div>
  
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">
          {{ medicalRecordForm.id ? "Update Medical Record" : "Save Medical Record" }}
        </button>
        <button
          type="button"
          class="btn btn-secondary ml-2"
          v-if="medicalRecordForm.id"
          @click="resetForm"
        >
          Cancel
        </button>
      </form>
  
      <hr class="my-5" />
  
      <!-- Tabel Medical Record List -->
      <h3 class="text-center">Medical Record List</h3>
      <div class="table-responsive">
        <table class="table table-dark table-striped">
          <thead>
            <tr>
              <th>Patient</th>
              <th>Diagnosis</th>
              <th>Treatment</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="medicalRecord in medicalRecordList" :key="medicalRecord.id">
              <td>{{ medicalRecord.patient.name }}</td>
              <td>{{ medicalRecord.diagnosis }}</td>
              <td>{{ medicalRecord.treatment }}</td>
              <td>
                <button
                  class="btn btn-warning btn-sm"
                  @click="editMedicalRecord(medicalRecord)"
                >
                  Edit
                </button>
                <button
                  class="btn btn-danger btn-sm"
                  @click="deleteMedicalRecord(medicalRecord.id)"
                >
                  Delete
                </button>
              </td>
            </tr>
            <tr v-if="medicalRecordList.length === 0">
              <td colspan="4" class="text-center">No medical records available</td>
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
        medicalRecordList: [],
        medicalRecordForm: {
          id: null,
          patient_id: "",
          diagnosis: "",
          treatment: "",
        },
        patients: [],
      };
    },
    methods: {
      // Fetch data for medical records
      async fetchMedicalRecords() {
        try {
          const response = await fetch("http://127.0.0.1:8000/api/medicals");
          const data = await response.json();
          if (data.success) {
            this.medicalRecordList = data.data;
          } else {
            console.error("Failed to fetch medical records:", data.message);
          }
        } catch (error) {
          console.error("Error fetching medical records:", error);
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
  
      // Save or update medical record
      async saveMedicalRecord() {
        const method = this.medicalRecordForm.id ? "PUT" : "POST";
        const url = this.medicalRecordForm.id
          ? `http://127.0.0.1:8000/api/medicals/${this.medicalRecordForm.id}`
          : "http://127.0.0.1:8000/api/medicals";
  
        try {
          const response = await fetch(url, {
            method: method,
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(this.medicalRecordForm),
          });
  
          const data = await response.json();
          if (data.success) {
            alert(
              `Medical Record ${
                this.medicalRecordForm.id ? "updated" : "created"
              } successfully!`
            );
            this.fetchMedicalRecords();
            this.resetForm();
          } else {
            alert(`Failed to ${this.medicalRecordForm.id ? "update" : "create"} medical record.`);
          }
        } catch (error) {
          console.error("Error saving medical record:", error);
          alert("An error occurred. Please try again.");
        }
      },
  
      // Edit medical record
      editMedicalRecord(medicalRecord) {
        this.medicalRecordForm = { ...medicalRecord };
      },
  
      // Delete medical record
      async deleteMedicalRecord(id) {
        if (confirm("Are you sure you want to delete this medical record?")) {
          try {
            const response = await fetch(
              `http://127.0.0.1:8000/api/medicals/${id}`,
              { method: "DELETE" }
            );
            const result = await response.json();
            if (result.success) {
              this.fetchMedicalRecords();
            } else {
              console.error("Error deleting medical record:", result.message);
            }
          } catch (error) {
            console.error("Error deleting medical record:", error);
          }
        }
      },
  
      // Reset form
      resetForm() {
        this.medicalRecordForm = {
          id: null,
          patient_id: "",
          diagnosis: "",
          treatment: "",
        };
      },
    },
    mounted() {
      this.fetchMedicalRecords(); // Fetch medical records data when component is mounted
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
  