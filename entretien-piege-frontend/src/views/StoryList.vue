<template>
  <section class="mx-auto max-w-3xl px-4 py-10 space-y-8">
    <!-- Titre de page -->
    <header class="space-y-2">
      <h1 class="text-2xl md:text-3xl font-extrabold text-white">
        Bienvenue à l'entretien piégé
      </h1>
      <div class="h-px w-full bg-gradient-to-r from-primary/60 via-primary/20 to-transparent"></div>
    </header>

    <!-- États de chargement / erreur -->
    <div v-if="loading" class="text-center py-10 text-gray-400">Chargement...</div>
    <div v-else-if="error" class="text-center py-10 text-red-400">Erreur lors du chargement des histoires.</div>

    <!-- Liste d'histoires -->
    <div v-else class="space-y-6">
      <article
        v-for="story in stories"
        :key="story.id"
        class="bg-white text-gray-900 rounded-2xl border shadow-sm p-6 md:p-8"
      >
        <!-- Titre + description -->
        <div class="space-y-2">
          <h2 class="text-lg md:text-xl font-semibold">{{ story.title }}</h2>
          <p class="text-gray-600">{{ story.description }}</p>
        </div>

        <!-- Actions -->
        <div class="mt-6">
          <!-- Utilisateur connecté -->
          <router-link
            v-if="authStore.isAuthenticated"
            :to="{ name: 'ChapterView', params: { id: getFirstChapterId(story) } }"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border
                   bg-gray-900 text-white hover:bg-gray-800
                   focus:outline-none focus-visible:ring-2 focus-visible:ring-primary
                   transition"
          >
            <i class="pi pi-play text-sm"></i>
            Commencer l'histoire
          </router-link>

          <!-- Invité -->
          <div v-else class="flex flex-col sm:flex-row sm:items-center gap-3">
            <p class="text-sm text-gray-600">Connectez-vous pour commencer cette histoire</p>
            <router-link
              to="/login"
              class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border
                     bg-white text-gray-900 hover:bg-gray-50
                     focus:outline-none focus-visible:ring-2 focus-visible:ring-primary
                     transition"
            >
              <i class="pi pi-sign-in text-sm"></i>
              Se connecter
            </router-link>
          </div>
        </div>
      </article>
    </div>
  </section>
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