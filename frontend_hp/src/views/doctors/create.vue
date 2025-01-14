<template>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Add Doctor</h2>

    <!-- Form Tambah Dokter -->
    <form @submit.prevent="saveDoctor">
      <div class="form-group">
        <label for="name">Name</label>
        <input
          type="text"
          id="name"
          class="form-control"
          v-model="doctorForm.name"
          placeholder="Enter Name"
          required
        />
      </div>
      <div class="form-group">
        <label for="specialization">Specialization</label>
        <input
          type="text"
          id="specialization"
          class="form-control"
          v-model="doctorForm.specialization"
          placeholder="Enter Specialization"
          required
        />
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input
          type="text"
          id="phone"
          class="form-control"
          v-model="doctorForm.phone"
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
          v-model="doctorForm.email"
          placeholder="Enter Email"
          required
        />
      </div>
      <button type="submit" class="btn btn-primary">Save Doctor</button>
      <router-link to="/doctors" class="btn btn-secondary ml-2">Cancel</router-link>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      doctorForm: {
        name: "",
        specialization: "",
        phone: "",
        email: "",
      },
    };
  },
  methods: {
    async saveDoctor() {
      try {
        const response = await fetch("http://127.0.0.1:8000/api/doctors", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(this.doctorForm),
        });
        const data = await response.json();
        if (data.success) {
          alert("Doctor added successfully!");
          this.$router.push("/doctors");
        } else {
          alert("Failed to add doctor.");
        }
      } catch (error) {
        console.error("Error saving doctor:", error);
        alert("An error occurred. Please try again.");
      }
    },
  },
};
</script>
