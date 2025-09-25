<template>
  <div class="min-h-[60vh] grid place-items-center px-4 py-12 display:column">
    <div class="w-full max-w-md bg-white rounded-2xl shadow border p-8">
      <div class="flex items-center gap-2 mb-6">
        <i class="pi pi-lock text-xl"></i>
        <h2 class="text-2xl font-bold text-gray-900">Connexion</h2>
      </div>

      <!-- Erreur globale -->
      <Message v-if="error" severity="error" :closable="false" class="mb-4">
        {{ error }}
      </Message>

      <form @submit.prevent="login" class="space-y-5">
        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium mb-1 text-gray-700">Email</label>
          <InputText
            id="email"
            type="email"
            v-model="form.email"
            class="w-full"
            placeholder="votre@email.ch"
            autocomplete="email"
            required
          />
        </div>

        <!-- Mot de passe -->
        <div>
          <label for="password" class="block text-sm font-medium mb-1">Mot de passe</label>
          <Password
            inputId="password"
            v-model="form.password"
            :feedback="false"
            toggleMask
            :inputStyle="{ width: '100%' }"
            inputClass="w-full"
            autocomplete="current-password"
            required
          />
        </div>

        <!-- Submit -->
        <Button
          type="submit"
          label="Se connecter"
          icon="pi pi-sign-in"
          class="w-full"
          :loading="loading"
          :disabled="loading"
        />
      </form>

      <p class="mt-6 text-center text-sm text-gray-600">
        Pas encore de compte ?
        <RouterLink to="/register" class="text-primary hover:underline">S'inscrire</RouterLink>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'

// Composants PrimeVue (importés localement pour éviter de toucher main.js)
import InputText from 'primevue/inputtext'
import Password from 'primevue/password'
import Button from 'primevue/button'
import Message from 'primevue/message'

const router = useRouter()
const authStore = useAuthStore()

const form = ref({ email: '', password: '' })
const error = ref('')
const loading = ref(false)

const login = async () => {
  try {
    loading.value = true
    error.value = ''

    const success = await authStore.login(form.value)
    if (success) {
      router.push('/')
    } else {
      error.value = 'Identifiants incorrects. Veuillez réessayer.'
    }
  } catch (e) {
    console.error(e)
    error.value = 'Une erreur est survenue. Veuillez réessayer.'
  } finally {
    loading.value = false
  }
}
</script>
