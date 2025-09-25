<template>
  <div display:column >
    <!-- Page title -->
    <h1 class="mb-4 text-2xl">Bienvenue à l'entretien piégé</h1>
    
    <!-- Loading state: Show a loading message while fetching stories -->
    <div v-if="loading">Chargement...</div>
    
    <!-- Error state: Show an error message if fetching stories fails -->
    <div v-else-if="error">Erreur lors du chargement des histoires.</div>
    
    <!-- Stories list -->
    <div v-else>
      <!-- Iterate over the list of stories and display each one -->
      <div v-for="story in stories" :key="story.id" class="story-card space-y-4">
        <!-- Story title -->
        <!--<h2>{{ story.title }}</h2>-->
        
        <!-- Story description -->
        <p>{{ story.description }}</p>
        
        <!-- Button to start the story if the user is authenticated -->
        <router-link v-if="authStore.isAuthenticated" 
                     :to="{ name: 'ChapterView', params: { id: getFirstChapterId(story) } }" 
                     class="start-btn">
          Commencer l'histoire
        </router-link>
        
        <!-- Message prompting the user to log in if not authenticated -->
        <div v-else class="auth-message">
          <p>Connectez-vous pour commencer cette histoire</p>
          <router-link to="/login" class="login-btn">Se connecter</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// Import Vue utilities and libraries
import { ref, onMounted } from 'vue'; // Reactive variables and lifecycle hook
import axios from 'axios'; // For making API requests
import { useAuthStore } from '../stores/auth';// Store for managing user authentication

// Reactive variables to manage the state of the component
const stories = ref([]); // List of stories
const loading = ref(true); // Loading state
const error = ref(false); // Error state
const authStore = useAuthStore(); // Access the authentication store

// Helper function to get the ID of the first chapter of a story
const getFirstChapterId = (story) => {
if (story.chapters && story.chapters.length > 0) {
  return story.chapters[0].id; // Return the first chapter ID if chapters exist
}
return null; // Return null if no chapters are available
};

// Lifecycle hook: Fetch stories when the component is mounted
onMounted(async () => {
try {
  // Fetch the list of stories
  const storiesData = await axios.get('/api/v1/stories');
  
  // Load additional details for each story to fetch the chapters
  for (const story of storiesData.data) {
    const storyDetail = await axios.get(`/api/v1/stories/${story.id}`);
    story.chapters = storyDetail.data.chapters; // Attach chapters to each story
  }
  
  stories.value = storiesData.data; // Update the stories list
} catch (err) {
  // Handle errors during the fetch process
  error.value = true;
  console.error('Erreur lors du chargement des histoires', err); // Log the error
} finally {
  // Set loading to false once the fetch process is complete
  loading.value = false;
}
});
</script>

<style scoped>
/* Styles for each story card */
.story-card {
border: 1px solid #eee; /* Light border for the card */
border-radius: 8px; /* Rounded corners */
padding: 20px; /* Padding inside the card */
margin-bottom: 20px; /* Space between cards */
box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle shadow for depth */
}

/* Styles for the "Start" and "Login" buttons */
.start-btn, .login-btn {
display: inline-block;
background-color: #4CAF50; /* Green background */
color: white; /* White text */
padding: 10px 15px; /* Padding for the button */
border-radius: 4px; /* Rounded corners */
text-decoration: none; /* Remove underline from links */
margin-top: 10px; /* Space above the button */
}

/* Styles for the message prompting users to log in */
.auth-message {
margin-top: 10px; /* Space above the message */
}
</style>