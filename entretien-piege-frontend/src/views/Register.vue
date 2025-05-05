<template>
  <div class="auth-form">
    <!-- Title for the registration form -->
    <h2>Inscription</h2>
    
    <!-- Display an error message if there is an error -->
    <div v-if="error" class="error-message">
      {{ error }}
    </div>
    
    <!-- Registration form -->
    <form @submit.prevent="register">
      <!-- Name input field -->
      <div class="form-group">
        <label for="name">Nom</label>
        <input 
          type="text" 
          id="name" 
          v-model="form.name" 
          required
        >
      </div>
      
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
          minlength="8"  
        >
       <!-- Enforces a minimum password length of 8 characters -->
      </div>
      
      <!-- Password confirmation input field -->
      <div class="form-group">
        <label for="password_confirmation">Confirmer le mot de passe</label>
        <input 
          type="password" 
          id="password_confirmation" 
          v-model="form.password_confirmation" 
          required
        >
      </div>
      
      <!-- Submit button; disables when loading -->
      <button type="submit" :disabled="loading">
        {{ loading ? 'Inscription en cours...' : 'S\'inscrire' }}
      </button>
    </form>
    
    <!-- Link to the login page -->
    <div class="auth-links">
      <p>Déjà un compte ? <router-link to="/login">Se connecter</router-link></p>
    </div>
  </div>
</template>

<script setup>
// Import Vue.js utilities and libraries
import { ref } from 'vue'; // For reactive variables
import { useRouter } from 'vue-router'; // For navigation
import { useAuthStore } from '../stores/auth'; // Authentication store for managing user accounts

// Router instance for navigation
const router = useRouter();

// Auth store instance for handling authentication logic
const authStore = useAuthStore();

// Reactive object for storing form input
const form = ref({
name: '', // Stores the name entered by the user
email: '', // Stores the email entered by the user
password: '', // Stores the password entered by the user
password_confirmation: '' // Stores the password confirmation entered by the user
});

// Reactive variable for error messages
const error = ref('');

// Reactive variable to track the loading state of the registration request
const loading = ref(false);

// Registration function triggered when the form is submitted
const register = async () => {
// Check if password and confirmation match
if (form.value.password !== form.value.password_confirmation) {
  error.value = 'Les mots de passe ne correspondent pas.'; // Display an error if they don't match
  return;
}

try {
  loading.value = true; // Set loading state to true
  error.value = ''; // Clear any previous error messages
  
  // Call the register method from the auth store with the form data
  const success = await authStore.register(form.value);
  
  if (success) {
    // Navigate to the homepage on successful registration
    router.push('/');
  } else {
    // Display an error message if registration fails
    error.value = "Erreur lors de l'inscription. Veuillez réessayer.";
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