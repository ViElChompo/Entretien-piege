import axios from 'axios';

// Base URL de l'API
axios.defaults.baseURL = 'http://localhost:8000';

// Configuration des headers
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.headers.common['Content-Type'] = 'application/json';

// Intercepteur pour ajouter le token à chaque requête
axios.interceptors.request.use(config => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export default axios;