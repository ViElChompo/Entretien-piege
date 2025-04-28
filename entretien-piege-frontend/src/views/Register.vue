<template>
    <div class="auth-form">
      <h2>Inscription</h2>
      
      <div v-if="error" class="error-message">
        {{ error }}
      </div>
      
      <form @submit.prevent="register">
        <div class="form-group">
          <label for="name">Nom</label>
          <input 
            type="text" 
            id="name" 
            v-model="form.name" 
            required
          >
        </div>
        
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
            minlength="8"
          >
        </div>
        
        <div class="form-group">
          <label for="password_confirmation">Confirmer le mot de passe</label>
          <input 
            type="password" 
            id="password_confirmation" 
            v-model="form.password_confirmation" 
            required
          >
        </div>
        
        <button type="submit" :disabled="loading">
          {{ loading ? 'Inscription en cours...' : 'S\'inscrire' }}
        </button>
      </form>
      
      <div class="auth-links">
        <p>Déjà un compte ? <router-link to="/login">Se connecter</router-link></p>
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
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
  });
  
  const error = ref('');
  const loading = ref(false);
  
  const register = async () => {
    if (form.value.password !== form.value.password_confirmation) {
      error.value = 'Les mots de passe ne correspondent pas.';
      return;
    }
    
    try {
      loading.value = true;
      error.value = '';
      
      const success = await authStore.register(form.value);
      
      if (success) {
        router.push('/');
      } else {
        error.value = 'Erreur lors de l\'inscription. Veuillez réessayer.';
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
  /* Même style que Login.vue */
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