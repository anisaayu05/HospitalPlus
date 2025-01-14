<template>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Room Allocation</h2>

    <!-- Form untuk Create/Update Room -->
    <form @submit.prevent="saveRoom">
      <div class="form-group">
        <label for="room-name">Room Name</label>
        <input
          type="text"
          id="room-name"
          class="form-control"
          v-model="roomForm.name"
          placeholder="Enter Room Name"
          required
        />
      </div>
      <div class="form-group">
        <label for="room-type">Room Type</label>
        <select
          id="room-type"
          class="form-control"
          v-model="roomForm.type"
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
          class="form-control"
          v-model="roomForm.capacity"
          placeholder="Enter Capacity"
          required
        />
      </div>
      <div class="form-group">
        <label for="room-status">Status</label>
        <select
          id="room-status"
          class="form-control"
          v-model="roomForm.status"
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
          class="form-control"
          v-model="roomForm.notes"
          rows="3"
          placeholder="Enter any additional notes (optional)"
        ></textarea>
      </div>
      <button type="submit" class="btn btn-primary">
        {{ roomForm.id ? "Update Room" : "Save Room" }}
      </button>
      <button
        type="button"
        class="btn btn-secondary ml-2"
        v-if="roomForm.id"
        @click="resetForm"
      >
        Cancel
      </button>
    </form>

    <hr class="my-5" />

    <!-- Tabel Room List -->
    <h3 class="text-center">Room List</h3>
    <div class="table-responsive">
      <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Capacity</th>
            <th>Status</th>
            <th>Notes</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
           <tr v-for="room in rooms" :key="room.id">
            <td>{{ room.name }}</td>
            <td>{{ room.type }}</td>
            <td>{{ room.capacity }}</td>
            <td>{{ room.status }}</td>
            <td>{{ room.notes || "No Notes" }}</td>
            <td>
              <button class="btn btn-warning btn-sm" @click="editRoom(room)">
                Edit
              </button>
              <button
                class="btn btn-danger btn-sm"
                @click="deleteRoom(room.id)"
              >
                Delete
              </button>
            </td>
          </tr>
          <tr v-if="rooms.length === 0">
            <td colspan="6" class="text-center">No rooms available</td>
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
      rooms: [], // Data rooms
      roomForm: {
        id: null,
        name: "",
        type: "ICU",
        capacity: "",
        status: "available",
        notes: "",
      },
    };
  },
  methods: {
  async fetchRooms() {
    try {
      const response = await fetch("http://127.0.0.1:8000/api/rooms");
      const data = await response.json();
      console.log("Data fetched:", data);
      if (data.success) {
        this.rooms = data.data;
        console.log("Rooms updated:", this.rooms);
      } else {
        console.error("Failed to fetch rooms:", data.message);
      }
    } catch (error) {
      console.error("Error fetching rooms:", error);
    }
  },

  // Fungsi untuk save atau update room
  async saveRoom() {
    const method = this.roomForm.id ? 'PUT' : 'POST';
    const url = this.roomForm.id
      ? `http://127.0.0.1:8000/api/rooms/${this.roomForm.id}`
      : 'http://127.0.0.1:8000/api/rooms';

    try {
      const response = await fetch(url, {
        method: method,
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(this.roomForm),
      });

      const data = await response.json();
      if (data.success) {
        alert(`Room ${this.roomForm.id ? 'updated' : 'created'} successfully!`);
        this.fetchRooms(); // Update list of rooms
        this.resetForm(); // Reset form after success
      } else {
        console.error("Error saving room:", data.message);
        alert(`Failed to ${this.roomForm.id ? 'update' : 'create'} room.`);
      }
    } catch (error) {
      console.error("Error saving room:", error);
      alert("An error occurred. Please try again.");
    }
  },

  editRoom(room) {
    this.roomForm = { ...room }; // Populate form with room data to edit
  },

  async deleteRoom(id) {
    if (confirm("Are you sure you want to delete this room?")) {
      try {
        const response = await fetch(
          `http://127.0.0.1:8000/api/rooms/${id}`,
          { method: "DELETE" }
        );
        const result = await response.json();
        if (result.success) {
          this.fetchRooms(); // Refresh room list
        } else {
          console.error("Error deleting room:", result.message);
        }
      } catch (error) {
        console.error("Error deleting room:", error);
      }
    }
  },

  resetForm() {
    this.roomForm = {
      id: null,
      name: "",
      type: "ICU",
      capacity: "",
      status: "available",
      notes: "",
    };
  },
},
  mounted() {
    this.fetchRooms(); // Fetch data saat komponen di-mount
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
