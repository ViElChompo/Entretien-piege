<template>
  <div class="auth-form">
    <!-- Title for the login form -->
    <h2>Connexion</h2>
    
    <!-- Display an error message if there is an error -->
    <div v-if="error" class="error-message">
      {{ error }}
    </div>
    
    <!-- Login form -->
    <form @submit.prevent="login">
      <!-- Email input field -->
      <div class="form-group">
        <label for="email">Email</label>
        <input 
          type="email" 
          id="email" 
          v-model="form.email" 
          required
        >
      </div>
      
      <!-- Password input field -->
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input 
          type="password" 
          id="password" 
          v-model="form.password" 
          required
        >
      </div>
      
      <!-- Submit button; disables when loading -->
      <button type="submit" :disabled="loading">
        {{ loading ? 'Connexion en cours...' : 'Se connecter' }}
      </button>
    </form>
    
    <!-- Link to the registration page -->
    <div class="auth-links">
      <p>Pas encore de compte ? <router-link to="/register">S'inscrire</router-link></p>
    </div>
  </div>
</template>

<script setup>
// Import Vue.js utilities and libraries
import { ref } from 'vue'; // For reactive variables
import { useRouter } from 'vue-router'; // For navigation
import { useAuthStore } from '../stores/auth'; // Authentication store for managing user sessions

// Router instance for navigation
const router = useRouter();

// Auth store instance for handling authentication logic
const authStore = useAuthStore();

// Reactive object for storing form input
const form = ref({
email: '', // Stores the email entered by the user
password: '' // Stores the password entered by the user
});

// Reactive variable for error messages
const error = ref('');

// Reactive variable to track the loading state of the login request
const loading = ref(false);

// Login function triggered when the form is submitted
const login = async () => {
try {
  loading.value = true; // Set loading state to true
  error.value = ''; // Clear any previous error messages
  
  // Call the login method from the auth store with the form data
  const success = await authStore.login(form.value);
  
  if (success) {
    // Navigate to the homepage on successful login
    router.push('/');
  } else {
    // Display an error message if login fails
    error.value = 'Identifiants incorrects. Veuillez réessayer.';
  }
} catch (err) {
  // Display a generic error message if an exception occurs
  error.value = 'Une erreur est survenue. Veuillez réessayer.';
  console.error(err); // Log the error for debugging
} finally {
  loading.value = false; // Set loading state to false after the request completes
}
};
</script>

<style scoped>
/* Styles for the main authentication form container */
.auth-form {
max-width: 400px; /* Maximum width of the form */
margin: 0 auto; /* Center the form horizontally */
padding: 20px; /* Padding inside the form */
border: 1px solid #eee; /* Light border */
border-radius: 8px; /* Rounded corners */
box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle shadow for depth */
}

/* Styles for individual form groups (input fields and labels) */
.form-group {
margin-bottom: 15px;
}

/* Styles for form labels */
label {
display: block;
margin-bottom: 5px;
font-weight: bold;
}

/* Styles for input fields */
input {
width: 100%;
padding: 10px;
border: 1px solid #ddd;
border-radius: 4px;
}

/* Styles for the submit button */
button {
width: 100%;
padding: 10px;
background-color: #4CAF50; /* Green background */
color: white; /* White text */
border: none;
border-radius: 4px;
cursor: pointer; /* Pointer cursor on hover */
font-size: 1em;
}

/* Styles for the submit button when disabled */
button:disabled {
background-color: #cccccc; /* Gray background */
cursor: not-allowed; /* Disabled cursor */
}

/* Styles for the error message display */
.error-message {
background-color: #f8d7da; /* Light red background */
color: #721c24; /* Dark red text */
padding: 10px;
border-radius: 4px;
margin-bottom: 15px;
}

/* Styles for the links under the form */
.auth-links {
margin-top: 20px;
text-align: center; /* Center-align the text */
}
</style>