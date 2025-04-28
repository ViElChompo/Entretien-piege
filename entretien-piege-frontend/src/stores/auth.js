import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: localStorage.getItem('token') || null
  }),
  getters: {
    isAuthenticated: (state) => !!state.token
  },
  actions: {
    async login(credentials) {
      try {
        const response = await axios.post('/api/v1/login', credentials)
        this.user = response.data.user
        this.token = response.data.token
        localStorage.setItem('token', this.token)
        
        // Configure Axios pour envoyer le token dans les requêtes
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        
        return true
      } catch (error) {
        console.error('Login failed:', error.response?.data || error.message)
        return false}
    },
    
    async register(userData) {
      try {
        const response = await axios.post('/api/v1/register', userData)
        this.user = response.data.user
        this.token = response.data.token
        localStorage.setItem('token', this.token)
        
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        
        return true
      } catch (error) {
        return false
      }
    },
    
    async logout() {
      try {
        await axios.post('/api/v1/logout')
      } catch (error) {
        console.error('Erreur lors de la déconnexion', error)
      } finally {
        this.user = null
        this.token = null
        localStorage.removeItem('token')
        delete axios.defaults.headers.common['Authorization']
      }
    },
    
    initAuth() {
      if (this.token) {
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      }
    }
  }
})