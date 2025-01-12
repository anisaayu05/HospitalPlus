<template>
  <div class="container">
    <h2>Edit Room</h2>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="room-name">Room Name</label>
        <input type="text" v-model="name" class="form-control" id="room-name" placeholder="Enter Room Name" required>
      </div>
      <div class="form-group">
        <label for="room-type">Room Type</label>
        <select v-model="type" class="form-control" id="room-type" required>
          <option value="ICU">ICU</option>
          <option value="Operation Theatre">Operation Theatre</option>
          <option value="General Ward">General Ward</option>
        </select>
      </div>
      <div class="form-group">
        <label for="room-capacity">Capacity</label>
        <input type="number" v-model="capacity" class="form-control" id="room-capacity" placeholder="Enter Capacity" required>
      </div>
      <div class="form-group">
        <label for="room-status">Status</label>
        <select v-model="status" class="form-control" id="room-status" required>
          <option value="available">Available</option>
          <option value="occupied">Occupied</option>
          <option value="maintenance">Maintenance</option>
        </select>
      </div>
      <div class="form-group">
        <label for="room-notes">Notes</label>
        <textarea v-model="notes" class="form-control" id="room-notes" rows="3" placeholder="Enter any additional notes (optional)"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Save Room</button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import api from '../../api';

const name = ref('');
const type = ref('');
const capacity = ref('');
const status = ref('');
const notes = ref('');
const route = useRoute();
const roomId = route.params.id;

const fetchRooms = async () => {
  try {
    const response = await api.get(`api/rooms/${roomId}`);
    const room = response.data;
    name.value = room.name;
    type.value = room.type;
    capacity.value = room.capacity;
    status.value = room.status;
    notes.value = room.notes;
  } catch (error) {
    console.error('Error fetching rooms:', error);
  }
};

const submitForm = async () => {
  try {
    await api.put(`api/rooms/${roomId}`, {
      name: name.value,
      type: type.value,
      capacity: capacity.value,
      status: status.value,
      notes: notes.value,
    });
    window.location.href = '/rooms';
  } catch (error) {
    console.error('Error updating room:', error);
  }
};

onMounted(() => {
  fetchRooms();
});
</script>
