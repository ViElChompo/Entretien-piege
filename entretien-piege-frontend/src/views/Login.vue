<template>
    <div class="auth-form">
      <h2>Connexion</h2>
      
      <div v-if="error" class="error-message">
        {{ error }}
      </div>
      
      <form @submit.prevent="login">
        <div class="form-group">
          <label for="email">Email</label>
          <input 
            type="email" 
            id="email" 
            v-model="form.email" 
            required
          >
        </div>
        
        <div class="form-group">
          <label for="password">Mot de passe</label>
          <input 
            type="password" 
            id="password" 
            v-model="form.password" 
            required
          >
        </div>
        
        <button type="submit" :disabled="loading">
          {{ loading ? 'Connexion en cours...' : 'Se connecter' }}
        </button>
      </form>
      
      <div class="auth-links">
        <p>Pas encore de compte ? <router-link to="/register">S'inscrire</router-link></p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  import { useAuthStore } from '../stores/auth';
  
  const router = useRouter();
  const authStore = useAuthStore();
  
  const form = ref({
    email: '',
    password: ''
  });
  
  const error = ref('');
  const loading = ref(false);
  
  const login = async () => {
    try {
      loading.value = true;
      error.value = '';
      
      const success = await authStore.login(form.value);
      
      if (success) {
        router.push('/');
      } else {
        error.value = 'Identifiants incorrects. Veuillez réessayer.';
      }
    } catch (err) {
      error.value = 'Une erreur est survenue. Veuillez réessayer.';
      console.error(err);
    } finally {
      loading.value = false;
    }
  };
  </script>
  
  <style scoped>
  .auth-form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #eee;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }
  
  input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
  }
  
  button {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1em;
  }
  
  button:disabled {
    background-color: #cccccc;
    cursor: not-allowed;
  }
  
  .error-message {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 15px;
  }
  
  .auth-links {
    margin-top: 20px;
    text-align: center;
  }
  </style>