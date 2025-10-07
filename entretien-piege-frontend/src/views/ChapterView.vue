<template>
  <!-- État de chargement -->
  <div v-if="loading" class="text-center py-10 text-gray-400">
    Chargement...
  </div>

  <!-- État d'erreur -->
  <div v-else-if="!chapter" class="text-center py-10 text-red-500">
    Chapitre introuvable
  </div>

  <!-- Contenu du chapitre -->
  <div v-else class="max-w-3xl mx-auto px-4 py-10 space-y-8">
    <!-- Titre -->
    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">
      {{ chapter.title }}
    </h2>

    <!-- Contenu -->
    <div class="bg-white text-gray-900 rounded-2xl border shadow-sm p-6 md:p-8 leading-relaxed">
      {{ chapter.content }}
    </div>

    <!-- Choix -->
    <div v-if="!chapter.is_ending" class="space-y-4">
      <h3 class="text-lg font-semibold text-gray-900">Que faites-vous ?</h3>

      <div class="space-y-3">
        <button
          v-for="choice in chapter.choices"
          :key="choice.id"
          @click="makeChoice(choice)"
          class="w-full text-left rounded-xl border bg-gray-50 px-4 py-3
                 hover:bg-white hover:shadow-sm
                 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary
                 transition text-gray-900"
        >
          {{ choice.text }}
        </button>
      </div>
    </div>

    <!-- Fin -->
    <div v-else class="space-y-6">
      <EndingScreen :ending="chapter.ending_type" />

      <router-link
        to="/"
        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border
               bg-gray-800 text-gray-100 hover:bg-gray-700
               focus:outline-none focus-visible:ring-2 focus-visible:ring-primary
               transition"
      >
        <i class="pi pi-arrow-left text-sm"></i>
        Retour à la liste des histoires
      </router-link>
    </div>
  </div>
</template>


<script setup>
// Import Vue.js utilities and libraries
import { ref, watch, onMounted } from 'vue'; // Reactive variables and lifecycle hooks
import { useRoute, useRouter } from 'vue-router'; // Router utilities for navigation
import axios from 'axios'; // For API requests
import { useProgressStore } from '../stores/progress'; // Store for managing user progress
import EndingScreen from './EndingScreen.vue'; // Component for rendering the ending screen

// Reactive variables to manage state
const route = useRoute(); // Access current route parameters
const router = useRouter(); // Navigate between routes
const chapter = ref(null); // Stores the current chapter data
const loading = ref(true); // Tracks loading state
const progressStore = useProgressStore(); // Store for tracking user progress

// Function to fetch chapter data from the API
async function loadChapter(id) {
try {
  loading.value = true; // Set loading state to true
  const res = await axios.get(`/api/v1/chapters/${id}`); // Fetch chapter data
  chapter.value = res.data; // Update chapter data
  progressStore.currentChapterId = id; // Update progress store with current chapter ID
} catch (error) {
  console.error('Erreur lors du chargement du chapitre', error); // Log error
  router.push('/'); // Redirect to homepage on error
} finally {
  loading.value = false; // Set loading state to false after attempt
}
}

// Function to handle user choice
async function makeChoice(choice) {
// Record the user's choice in the progress store
progressStore.choicesMade.push({
  chapter_id: chapter.value.id, // Current chapter ID
  choice_id: choice.id, // Chosen option ID
  choice_text: choice.text // Chosen option text
});

try {
  await progressStore.saveProgress(chapter.value.story_id); // Save the user's progress

  // Navigate to the next chapter if available
  if (choice.next_chapter_id) {
    router.push({ name: 'ChapterView', params: { id: choice.next_chapter_id } });
  } else {
    // If no next chapter, alert the user and redirect to the homepage
    alert('Fin de l\'histoire');
    router.push('/');
  }
} catch (error) {
  console.error('Erreur lors de la sauvegarde de la progression', error); // Log error
}
}

// Watch for changes in the route parameter (chapter ID)
watch(() => route.params.id, (newId) => {
if (newId) {
  loadChapter(newId); // Reload chapter when the ID changes
}
});

// Load the initial chapter when the component is mounted
onMounted(() => {
if (route.params.id) {
  loadChapter(route.params.id);
}
});
</script>

<style scoped>
/* Styles for the chapter container */
.chapter-container {
margin-bottom: 40px;
}

/* Styles for the chapter content */
.chapter-content {
margin: 20px 0;
line-height: 1.6;
font-size: 1.1em;
}

/* Styles for the choices container */
.choices-container {
margin-top: 30px;
}

/* Styles for individual choice buttons */
.choice-button {
display: block;
width: 100%;
padding: 15px;
margin: 10px 0;
background-color: #f5f5f5;
border: 1px solid #ddd;
border-radius: 4px;
cursor: pointer;
text-align: left;
font-size: 1em;
transition: background-color 0.2s;
}

/* Hover effect for choice buttons */
.choice-button:hover {
background-color: #e0e0e0;
}

/* Styles for the "back to stories" button */
.back-button {
display: inline-block;
margin-top: 20px;
padding: 10px 15px;
background-color: #4CAF50;
color: white;
text-decoration: none;
border-radius: 4px;
}
</style>