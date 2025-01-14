<template>
  <section id="edit-room" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Edit Room</h2>
      <form @submit.prevent="updateRoom">
        <div class="form-group">
          <label for="room-name">Room Name</label>
          <input
            type="text"
            class="form-control"
            id="room-name"
            v-model="room.name"
            placeholder="Enter Room Name"
            required
          />
        </div>
        <div class="form-group">
          <label for="room-type">Room Type</label>
          <select
            class="form-control"
            id="room-type"
            v-model="room.type"
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
            class="form-control"
            id="room-capacity"
            v-model="room.capacity"
            placeholder="Enter Capacity"
            required
          />
        </div>
        <div class="form-group">
          <label for="room-status">Status</label>
          <select
            class="form-control"
            id="room-status"
            v-model="room.status"
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
            class="form-control"
            id="room-notes"
            v-model="room.notes"
            placeholder="Enter any additional notes"
            rows="3"
          ></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Room</button>
      </form>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      room: {
        name: "",
        type: "",
        capacity: null,
        status: "available",
        notes: "",
      },
      errors: {},
    };
  },
  async created() {
    const roomId = this.$route.params.id;
    try {
      const response = await fetch(`http://127.0.0.1:8000/api/rooms/${roomId}`);
      if (!response.ok) {
        throw new Error('Failed to fetch room details');
      }
      const data = await response.json();
      this.room = data;
      console.log("Fetched room data:", this.room); // Debug: Log data after fetching
    } catch (error) {
      console.error("Error fetching room:", error);
      alert("Failed to fetch room details. Please try again.");
    }
  },
  methods: {
    async updateRoom() {
      const roomId = this.$route.params.id;

      // Debug: Indicate button clicked
      console.log("Update Room button clicked");
      alert("Update Room button clicked. Attempting to update...");

      // Debug: Log data before update
      console.log("Attempting to update room with ID:", roomId);
      console.log("Updated room data:", this.room);

      try {
        const response = await fetch(`http://127.0.0.1:8000/api/rooms/${roomId}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(this.room),
        });

        if (!response.ok) {
          throw new Error('Failed to update room');
        }

        const data = await response.json();

        // Debug and alert on success
        console.log("Update successful, response data:", data);
        alert(`Room updated successfully!\nUpdated data:\nName: ${this.room.name}\nType: ${this.room.type}\nCapacity: ${this.room.capacity}\nStatus: ${this.room.status}\nNotes: ${this.room.notes}`);

        this.$router.push("/rooms");
      } catch (error) {
        // Debug and alert on error
        console.error("Error updating room:", error);
        alert(`Failed to update room.\nError: ${error.message}`);
        this.errors = error.response?.data?.errors || {};
      }
    },
  },
};
</script>