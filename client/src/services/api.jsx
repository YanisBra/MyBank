// src/services/api.js
import axios from "axios";

const api = axios.create({
  // baseURL: import.meta.env.VITE_API_URL,
  baseURL: "http://localhost:8000/",
});

export default api;
