<template>
  <nav>
    <div class="logo">
      <router-link to="/">Entretien Piégé</router-link>
    </div>
    <span>
      Bonjour {{
        authStore.isAuthenticated ? authStore.user?.name : "Invité"
      }}</span
    >
    <div class="nav-links">
      <template v-if="authStore.isAuthenticated">
        <button @click="logout">Déconnexion</button>
      </template>
      <template v-else>
        <router-link to="/login">Connexion</router-link>
        <router-link to="/register">Inscription</router-link>
      </template>
    </div>
  </nav>
</template>

<script setup>
import { useAuthStore } from "../stores/auth";
import { useRouter } from "vue-router";

const authStore = useAuthStore();
const router = useRouter();

console.log("Nom utilisateur connecté :", authStore.user);

const logout = async () => {
  await authStore.logout();
  router.push("/login");
};
</script>

<style scoped>
nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 0;
  border-bottom: 1px solid #eee;
}

.logo a {
  font-size: 1.5rem;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}

.nav-links a,
.nav-links button {
  margin-left: 15px;
  text-decoration: none;
  color: #333;
}

button {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 1rem;
}
</style>
