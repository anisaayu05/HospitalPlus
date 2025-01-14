<template>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Add Patient</h2>

    <!-- Form Tambah Pasien -->
    <form @submit.prevent="savePatient">
      <div class="form-group">
        <label for="name">Name</label>
        <input
          type="text"
          id="name"
          class="form-control"
          v-model="patientForm.name"
          placeholder="Enter Name"
          required
        />
      </div>
      <div class="form-group">
        <label for="date_of_birth">Date of Birth</label>
        <input
          type="date"
          id="date_of_birth"
          class="form-control"
          v-model="patientForm.date_of_birth"
          required
        />
      </div>
      <div class="form-group">
        <label for="gender">Gender</label>
        <select
          id="gender"
          class="form-control"
          v-model="patientForm.gender"
          required
        >
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input
          type="text"
          id="address"
          class="form-control"
          v-model="patientForm.address"
          placeholder="Enter Address"
          required
        />
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input
          type="text"
          id="phone"
          class="form-control"
          v-model="patientForm.phone"
          placeholder="Enter Phone"
          required
        />
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="email"
          id="email"
          class="form-control"
          v-model="patientForm.email"
          placeholder="Enter Email"
          required
        />
      </div>
      <div class="form-group">
        <label for="photo">Photo</label>
        <input
          type="file"
          id="photo"
          class="form-control"
          @change="handlePhotoUpload"
        />
      </div>
      <div class="form-group">
        <label for="medical_history">Medical History</label>
        <textarea
          id="medical_history"
          class="form-control"
          v-model="patientForm.medical_history"
          placeholder="Enter Medical History"
          rows="3"
        ></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Save Patient</button>
      <router-link to="/patients" class="btn btn-secondary ml-2">Cancel</router-link>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      patientForm: {
        name: "",
        date_of_birth: "",
        gender: "male",
        address: "",
        phone: "",
        email: "",
        photo_path: "",
        medical_history: "",
      },
    };
  },
  methods: {
    async savePatient() {
      try {
        const formData = new FormData();
        Object.keys(this.patientForm).forEach((key) => {
          formData.append(key, this.patientForm[key]);
        });

        const response = await fetch("http://127.0.0.1:8000/api/patients", {
          method: "POST",
          body: formData,
        });
        const data = await response.json();
        if (data.success) {
          alert("Patient added successfully!");
          this.$router.push("/patients");
        } else {
          alert("Failed to add patient.");
        }
      } catch (error) {
        console.error("Error saving patient:", error);
        alert("An error occurred. Please try again.");
      }
    },

    handlePhotoUpload(event) {
      this.patientForm.photo_path = event.target.files[0];
    },
  },
};
</script>
