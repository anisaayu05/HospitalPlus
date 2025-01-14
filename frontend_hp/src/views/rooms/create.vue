<template>
  <div class="container mt-5">
    <h2 class="text-center">Room Allocation</h2>

    <form @submit.prevent="saveRoom">
      <div class="form-group">
        <label for="room-name">Room Name</label>
        <input
          type="text"
          id="room-name"
          v-model="room.name"
          class="form-control"
          placeholder="Enter Room Name"
          required
        />
      </div>

      <div class="form-group">
        <label for="room-type">Room Type</label>
        <select
          id="room-type"
          v-model="room.type"
          class="form-control"
          required
        >
          <option value="ICU">ICU</option>
          <option value="Operation Theatre">Operation Theatre</option>
          <option value="General Ward">General Ward</option>
        </select>
      </div>

      <div class="form-group">
        <label for="room-capacity">Capacity</label>
        <input
          type="number"
          id="room-capacity"
          v-model="room.capacity"
          class="form-control"
          placeholder="Enter Capacity"
          required
        />
      </div>

      <div class="form-group">
        <label for="room-status">Status</label>
        <select
          id="room-status"
          v-model="room.status"
          class="form-control"
          required
        >
          <option value="available">Available</option>
          <option value="occupied">Occupied</option>
          <option value="maintenance">Maintenance</option>
        </select>
      </div>

      <div class="form-group">
        <label for="room-notes">Notes</label>
        <textarea
          id="room-notes"
          v-model="room.notes"
          class="form-control"
          rows="3"
          placeholder="Enter any additional notes (optional)"
        ></textarea>
      </div>

      <button type="submit" class="btn btn-primary btn-block">Save Room</button>
    </form>
  </div>
</template>

<script>
import api from "../../api"; // Pastikan path API sesuai

export default {
  data() {
    return {
      room: {
        name: "",
        type: "",
        capacity: "",
        status: "available",
        notes: "",
      },
      errors: {},
    };
  },
  methods: {
    async saveRoom() {
      try {
        const response = await api.post("/api/rooms", this.room);

        // Cek response dan tampilkan alert
        if (response.data.success) {
          alert("Room has been saved!");
          this.resetForm();
          this.$router.push("/rooms"); // Redirect ke halaman rooms
        } else {
          alert("Failed to save room.");
        }
      } catch (error) {
        console.error("Error saving room:", error);
        this.errors = error.response?.data?.errors || {};
        alert("Failed to save room.");
      }
    },
    resetForm() {
      this.room = {
        name: "",
        type: "",
        capacity: "",
        status: "available",
        notes: "",
      };
      this.errors = {}; // Reset errors
    },
  },
};
</script>

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
</style>
