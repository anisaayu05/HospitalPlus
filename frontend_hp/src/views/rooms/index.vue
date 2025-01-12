<template>
  <div class="container">
    <h2>Room List</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Room Name</th>
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
          <td>{{ room.notes || 'No Notes' }}</td>
          <td>
            <button class="btn btn-warning" @click="editRoom(room.id)">Edit</button>
            <button class="btn btn-danger" @click="deleteRoom(room.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../../api'; 

const rooms = ref([]);

const fetchDataRooms = async () => {
  try {
    const response = await api.get('api/rooms');
    rooms.value = response.data;
  } catch (error) {
    console.error('Error fetching room:', error);
  }
};

const deleteRoom = async (id) => {
  if (confirm('Apakah Anda yakin ingin menghapus room ini?')) {
    try {
      await api.delete(`api/rooms/${id}`);
      fetchDataRooms(); 
    } catch (error) {
      console.error('Error deleting room:', error);
    }
  }
};

const editRoom = (id) => {
  window.location.href = `/rooms/edit/${id}`;
};

onMounted(() => {
  fetchDataRooms();
});
</script>
