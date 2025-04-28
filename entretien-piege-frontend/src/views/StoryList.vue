<template>
    <div>
      <h1>Histoires disponibles</h1>
      <div v-if="loading">Chargement...</div>
      <div v-else-if="error">Erreur lors du chargement des histoires.</div>
      <div v-else>
        <div v-for="story in stories" :key="story.id" class="story-card">
          <h2>{{ story.title }}</h2>
          <p>{{ story.description }}</p>
          <router-link v-if="authStore.isAuthenticated" 
                       :to="{ name: 'ChapterView', params: { id: getFirstChapterId(story) } }" 
                       class="start-btn">
            Commencer l'histoire
          </router-link>
          <div v-else class="auth-message">
            <p>Connectez-vous pour commencer cette histoire</p>
            <router-link to="/login" class="login-btn">Se connecter</router-link>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useAuthStore } from '../stores/auth';
  
  const stories = ref([]);
  const loading = ref(true);
  const error = ref(false);
  const authStore = useAuthStore();
  
  const getFirstChapterId = (story) => {
    if (story.chapters && story.chapters.length > 0) {
      return story.chapters[0].id;
    }
    return null;
  };
  
  onMounted(async () => {
    try {
      const res = await axios.get('/api/v1/stories');
      
      // Charger aussi les détails de chaque histoire pour avoir les premiers chapitres
      for (const story of res.data) {
        const storyDetail = await axios.get(`/api/v1/stories/${story.id}`);
        story.chapters = storyDetail.data.chapters;
      }
      
      stories.value = res.data;
    } catch (err) {
      error.value = true;
      console.error('Erreur lors du chargement des histoires', err);
    } finally {
      loading.value = false;
    }
  });
  </script>
  
  <style scoped>
  .story-card {
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }
  
  .start-btn, .login-btn {
    display: inline-block;
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border-radius: 4px;
    text-decoration: none;
    margin-top: 10px;
  }
  
  .auth-message {
    margin-top: 10px;
  }
  </style>