<template>
    <div v-if="loading">Chargement...</div>
    <div v-else-if="!chapter">Chapitre introuvable</div>
    <div v-else class="chapter-container">
      <h2>{{ chapter.title }}</h2>
      <div class="chapter-content">{{ chapter.content }}</div>
      
      <div v-if="!chapter.is_ending" class="choices-container">
        <h3>Que faites-vous ?</h3>
        <button 
          v-for="choice in chapter.choices" 
          :key="choice.id" 
          @click="makeChoice(choice)"
          class="choice-button"
        >
          {{ choice.text }}
        </button>
      </div>
      
      <div v-else class="ending-container">
        <EndingScreen :ending="chapter.ending_type" />
        <router-link to="/" class="back-button">Retour à la liste des histoires</router-link>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, watch, onMounted } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  import axios from 'axios';
  import { useProgressStore } from '../stores/progress';
  import EndingScreen from './EndingScreen.vue';
  
  const route = useRoute();
  const router = useRouter();
  const chapter = ref(null);
  const loading = ref(true);
  const progressStore = useProgressStore();
  
  async function loadChapter(id) {
    try {
      loading.value = true;
      const res = await axios.get(`/api/v1/chapters/${id}`);
      chapter.value = res.data;
      progressStore.currentChapterId = id;
    } catch (error) {
      console.error('Erreur lors du chargement du chapitre', error);
      router.push('/');
    } finally {
      loading.value = false;
    }
  }
  
  async function makeChoice(choice) {
    progressStore.choicesMade.push({
      chapter_id: chapter.value.id,
      choice_id: choice.id,
      choice_text: choice.text
    });
  
    try {
      await progressStore.saveProgress(chapter.value.story_id);
      
      if (choice.next_chapter_id) {
        router.push({ name: 'ChapterView', params: { id: choice.next_chapter_id } });
      } else {
        alert('Fin de l\'histoire');
        router.push('/');
      }
    } catch (error) {
      console.error('Erreur lors de la sauvegarde de la progression', error);
    }
  }
  
  watch(() => route.params.id, (newId) => {
    if (newId) {
      loadChapter(newId);
    }
  });
  
  onMounted(() => {
    if (route.params.id) {
      loadChapter(route.params.id);
    }
  });
  </script>
  
  <style scoped>
  .chapter-container {
    margin-bottom: 40px;
  }
  
  .chapter-content {
    margin: 20px 0;
    line-height: 1.6;
    font-size: 1.1em;
  }
  
  .choices-container {
    margin-top: 30px;
  }
  
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
  
  .choice-button:hover {
    background-color: #e0e0e0;
  }
  
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
  