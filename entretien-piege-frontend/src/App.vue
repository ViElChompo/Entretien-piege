<template>
  <!-- Fond global + halos -->
  <div
    class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-800 relative overflow-hidden"
  >
    <div
      class="pointer-events-none absolute -top-40 -left-40 w-96 h-96 bg-primary/25 rounded-full blur-3xl"
    ></div>
    <div
      class="pointer-events-none absolute -bottom-40 -right-40 w-96 h-96 bg-emerald-400/20 rounded-full blur-3xl"
    ></div>

    <!-- Wrapper hauteur écran + centrage -->
    <div
      class="relative mx-auto w-full max-w-4xl px-4 sm:px-6 min-h-screen flex items-center"
    >
      <!-- Carte avec + de hauteur pour éviter le scroll -->
      <div
        class="bg-white/95 text-gray-900 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/40 overflow-hidden w-full h-[80vh] flex flex-col"
      >
        <!-- NavBar avec padding interne -->
        <div class="px-8 sm:px-12 py-3 bg-transparent border-b border-gray-200">
          <NavBar />
        </div>

        <!-- Contenu aligné -->
        <div class="flex-1 px-8 sm:px-12 py-8 sm:py-12 overflow-auto">
          <main>
            <router-view />
          </main>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from "vue";
import NavBar from "./components/NavBar.vue";
import { useAuthStore } from "./stores/auth";
const authStore = useAuthStore();
onMounted(() => authStore.initAuth());
</script>
