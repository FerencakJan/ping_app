<template>
  <div class="container">
    <h1>Ping demo</h1>

    <!-- jednoduchý formulár na odoslanie pingu -->
    <form @submit.prevent="sendPing" class="form">
      <div class="field">
        <label>UUID</label>
        <input v-model="uuid" type="text" required />
      </div>

      <div class="field">
        <label>Battery percent</label>
        <input
          v-model.number="batteryPercent"
          type="number"
          min="0"
          max="100"
          required
        />
      </div>

      <button type="submit" :disabled="loading">
        {{ loading ? "Sending..." : "Send" }}
      </button>
    </form>

    <!-- jednoduché hlášky o úspechu alebo chybe -->
    <p v-if="message" class="success">{{ message }}</p>
    <p v-if="error" class="error">{{ error }}</p>
  </div>
</template>

<script setup>
// jednoduchý state
import { ref } from "vue";

const uuid = ref("");
const batteryPercent = ref(null);
const loading = ref(false);
const message = ref("");
const error = ref("");

// backend endpoint
const API_URL = "http://localhost:8000/api/ping";

// odoslanie pingu
async function sendPing() {
  loading.value = true;
  message.value = "";
  error.value = "";

  try {
    const res = await fetch(API_URL, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        uuid: uuid.value,
        battery_percent: batteryPercent.value,
      }),
    });

    const data = await res.json();

    if (data.status === "ok") {
      message.value = "Ping sent successfully.";
      uuid.value = "";
      batteryPercent.value = null;
    } else {
      error.value = "Unexpected server response.";
    }
  } catch (e) {
    // nedostupný backend, zlá URL, CORS atď.
    error.value = "Failed to connect to backend.";
  } finally {
    loading.value = false;
  }
}
</script>

<style scoped>
/* celkový layout */
.container {
  max-width: 420px;
  margin: 60px auto;
  padding: 30px;
  background: #ffffff;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.08);
  font-family: system-ui, sans-serif;
}

/* nadpis */
h1 {
  text-align: center;
  margin-bottom: 25px;
  font-size: 24px;
  color: #111; /* nech je určite tmavý */
}

/* formulár */
.form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

/* label + input polia */
.field {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

label {
  font-size: 14px;
  color: #333; /* toto ti doteraz chýbalo, preto si nič nevidel */
}

input {
  padding: 8px 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 15px;
  background: #fff;
  color: #000;
}

/* odstránenie šípok pri number type */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type="number"] {
  -moz-appearance: textfield;
}

/* tlačidlo */
button {
  padding: 10px;
  cursor: pointer;
  background: #3478f6;
  color: #fff;
  border: none;
  border-radius: 4px;
  transition: 0.2s;
  font-size: 15px;
}

button:hover {
  background: #2f6bd5;
}

button:disabled {
  background: #a7c3f5;
  cursor: not-allowed;
}

/* hlášky */
.success {
  margin-top: 15px;
  color: #2d8a3e;
  text-align: center;
}

.error {
  margin-top: 15px;
  color: #d33;
  text-align: center;
}
</style>
