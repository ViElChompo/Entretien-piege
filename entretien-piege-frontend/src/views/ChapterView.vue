<template>
  <!-- Display loading message while the chapter is being fetched -->
  <div v-if="loading">Chargement...</div>
  
  <!-- Display error message if the chapter is not found -->
  <div v-else-if="!chapter">Chapitre introuvable</div>
  
  <!-- Main container for chapter content -->
  <div v-else class="chapter-container">
    <!-- Display the chapter title -->
    <h2>{{ chapter.title }}</h2>
    
    <!-- Display the chapter content -->
    <div class="chapter-content">{{ chapter.content }}</div>
    
    <!-- Conditional rendering for choices if the chapter is not an ending -->
    <div v-if="!chapter.is_ending" class="choices-container">
      <h3>Que faites-vous ?</h3>
      
      <!-- Render a button for each choice -->
      <button 
        v-for="choice in chapter.choices" 
        :key="choice.id" 
        @click="makeChoice(choice)"
        class="choice-button"
      >
        {{ choice.text }}
      </button>
    </div>
    
    <!-- If the chapter is an ending, display the ending screen -->
    <div v-else class="ending-container">
      <!-- Component to display the ending type -->
      <EndingScreen :ending="chapter.ending_type" />
      <!-- Link to return to the list of stories -->
      <router-link to="/" class="back-button">Retour à la liste des histoires</router-link>
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