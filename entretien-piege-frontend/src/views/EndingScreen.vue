<template>
  <div class="ending-screen">
    <!-- Display the title of the ending screen -->
    <h3 class="text-gray-900 text-xl font-bold">Fin de l'histoire</h3>

    <!-- Conditional rendering for different types of endings -->

    <!-- Case: "accepted" ending -->
    <div v-if="ending === 'accepted'" class="ending accepted text-gray-900">
      <div class="icon">✅</div>
      <!-- Icon for accepted ending -->
      <p>Félicitations, vous êtes accepté !</p>
      <p>
        L'entreprise a apprécié votre candidature et vous propose de rejoindre
        leur équipe.
      </p>
    </div>

    <!-- Case: "rejected" ending -->
    <div v-else-if="ending === 'rejected'" class="ending rejected text-gray-900">
      <div class="icon">❌</div>
      <!-- Icon for rejected ending -->
      <p>Désolé, votre candidature a été refusée.</p>
      <p>L'entreprise a décidé de ne pas donner suite à votre candidature.</p>
    </div>

    <!-- Case: "blacklisted" ending -->
    <div v-else-if="ending === 'blacklisted'" class="ending blacklisted text-gray-900">
      <div class="icon">🚫</div>
      <!-- Icon for blacklisted ending -->
      <p>Vous êtes blacklisté de cette entreprise.</p>
      <p>
        Vos réponses lors de l'entretien ont mis en évidence des problèmes
        éthiques majeurs.
      </p>
    </div>
  </div>
</template>

<script setup>
// Define props for the component
// `ending` is a string that determines which ending to display
const props = defineProps({
  ending: String, // Expected to be one of "accepted", "rejected", or "blacklisted"
});
</script>

<style scoped>
/* Styles for the main container of the ending screen */
.ending-screen {
  text-align: center;
  padding: 30px;
  background-color: #f9f9f9;
  border-radius: 8px;
  margin: 20px 0;
}

/* General styles for each ending type */
.ending {
  padding: 20px;
  border-radius: 8px;
  margin-top: 20px;
}

/* Style for the icon in each ending */
.icon {
  font-size: 3em;
  margin-bottom: 15px;
}

/* Specific styles for "accepted" ending */
.accepted {
  background-color: #e6f7e6;
  border: 1px solid #c3e6cb;
}

/* Specific styles for "rejected" ending */
.rejected {
  background-color: #f8d7da;
  border: 1px solid #f5c6cb;
}

/* Specific styles for "blacklisted" ending */
.blacklisted {
  background-color: #f8d7da;
  border: 1px solid #f5c6cb;
  color: #721c24; /* Text color to indicate a more severe tone */
}
</style>
