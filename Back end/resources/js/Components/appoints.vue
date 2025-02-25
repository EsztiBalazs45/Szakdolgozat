<template>
  <Head title="Appointments" />
    <div class="main-container">
      <h1 class="text-2xl font-bold text-center mb-6">Foglalási rendszer</h1>
      <div class="calendar-booking">
        <h2 class="text-xl font-bold mb-4">Időpontfoglalás</h2>
        <VueDatePicker v-model="selectedDate" @update:modelValue="fetchAvailableTimes" />
        <div v-if="availableTimes.length" class="mt-4">
          <h3 class="text-lg font-semibold">Elérhető időpontok:</h3>
          <ul class="mt-2">
            <li v-for="time in availableTimes" :key="time">
              <button @click="bookTime(time)" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                {{ time }}
              </button>
            </li>
          </ul>
        </div>
        <p v-else class="text-red-500 mt-4">Nincsenek elérhető időpontok erre a napra.</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import VueDatePicker from '@vuepic/vue-datepicker';
  import '@vuepic/vue-datepicker/dist/main.css';
  import { ref } from 'vue';
  import { Head } from '@inertiajs/vue3';
  
  const selectedDate = ref(null);
  const availableTimes = ref([]);
  
  const fetchAvailableTimes = async () => {
    if (!selectedDate.value) return;
    const response = await fetch(`http://127.0.0.1:8000/appointment/available-times?date=${selectedDate.value.toISOString().split('T')[0]}`);
    const data = await response.json();
    availableTimes.value = data.times;
  };
  
  const bookTime = async (time) => {
    const response = await fetch('http://127.0.0.1:8000/appointment/bookingPage', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ date: selectedDate.value, time }),
    });
    const result = await response.json();
    if (result.success) {
      alert('Foglalás sikeres!');
      fetchAvailableTimes();
    } else {
      alert('Hiba történt a foglalás során.');
    }
  };
  </script>
  
  <style scoped>
  .main-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: #f9f9f9;
  }
  
  .calendar-booking {
    max-width: 400px;
    margin: auto;
    padding: 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    background-color: white;
  }
  </style>