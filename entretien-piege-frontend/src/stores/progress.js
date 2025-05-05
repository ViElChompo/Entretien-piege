import { defineStore } from 'pinia'
import axios from 'axios'

export const useProgressStore = defineStore('progress', {
  state: () => ({
    currentChapterId: null,
    choicesMade: []
  }),
  actions: {
    async saveProgress(storyId) {

        await axios.post('/api/v1/progress/save', {
          story_id: storyId,
          current_chapter_id: this.currentChapterId,
          choices_made: this.choicesMade
        }).then((response) => {
          console.log('Progression sauvegardée', response.data)
        } ).catch((error) => {
          console.error('Erreur sauvegarde progression', error)
        } ) 
      
    },
    
    async loadProgress(storyId) {
      try {
        const response = await axios.get(`/api/v1/progress/${storyId}`)
        this.currentChapterId = response.data.current_chapter_id
        this.choicesMade = response.data.choices_made || []
        return response.data
      } catch (error) {
        console.error('Erreur chargement progression', error)
        return null
      }
    },
    
    reset() {
      this.currentChapterId = null
      this.choicesMade = []
    }
  }
})