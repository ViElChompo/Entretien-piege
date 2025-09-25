<template>
  <!-- Neutre : pas de bg/border/padding ici -->
  <nav class="flex items-center justify-between">
    <!-- Logo -->
    <div class="underline-offset-8 capitalize font-bold text-lg text-emerald-600">
      <router-link to="/">Entretien Piégé</router-link>
    </div>

    <!-- Message utilisateur -->
    <span class="text-sm text-gray-700">
      Bonjour {{ authStore.isAuthenticated ? authStore.user?.name : 'Invité' }}
    </span>

    <!-- Actions -->
    <div class="flex items-center gap-4">
      <template v-if="authStore.isAuthenticated">
        <button @click="logout" class="text-sm text-gray-700 hover:text-gray-900 transition">
          Déconnexion
        </button>
      </template>
      <template v-else>
        <router-link
          to="/register"
          class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg
                 bg-gray-900 text-white text-sm hover:bg-gray-800
                 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary
                 transition"
        >
          <i class="pi pi-user-plus text-sm"></i>
          Inscription
        </router-link>
      </template>
    </div>
  </nav>
</template>

<script setup>
import { useAuthStore } from "../stores/auth";
import { useRouter } from "vue-router";
const authStore = useAuthStore();
const router = useRouter();
const logout = async () => { await authStore.logout(); router.push("/login"); };
</script>
