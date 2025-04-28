import { createRouter, createWebHistory } from 'vue-router'
import StoryList from './views/StoryList.vue'
import ChapterView from './views/ChapterView.vue'
import Login from './views/Login.vue'
import Register from './views/Register.vue'
import { useAuthStore } from './stores/auth'

const routes = [
  { path: '/', name: 'StoryList', component: StoryList },
  { path: '/chapter/:id', name: 'ChapterView', component: ChapterView, props: true, meta: { requiresAuth: true } },
  { path: '/login', name: 'Login', component: Login },
  { path: '/register', name: 'Register', component: Register }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()
  
  if (to.meta.requiresAuth && !authStore.isAuthenticated) {
    next('/login')
  } else {
    next()
  }
})

export default router