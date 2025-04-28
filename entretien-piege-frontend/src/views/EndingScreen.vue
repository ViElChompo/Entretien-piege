<template>
    <div class="ending-screen">
      <h3>Fin de l'histoire</h3>
      
      <div v-if="ending === 'accepted'" class="ending accepted">
        <div class="icon">✅</div>
        <p>Félicitations, vous êtes accepté !</p>
        <p>L'entreprise a apprécié votre candidature et vous propose de rejoindre leur équipe.</p>
      </div>
      
      <div v-else-if="ending === 'rejected'" class="ending rejected">
        <div class="icon">❌</div>
        <p>Désolé, votre candidature a été refusée.</p>
        <p>L'entreprise a décidé de ne pas donner suite à votre candidature.</p>
      </div>
      
      <div v-else-if="ending === 'blacklisted'" class="ending blacklisted">
        <div class="icon">⛔</div>
        <p>Vous êtes blacklisté de cette entreprise.</p>
        <p>Vos réponses lors de l'entretien ont mis en évidence des problèmes éthiques majeurs.</p>
      </div>
    </div>
  </template>
  
  <script setup>
  const props = defineProps({
    ending: String
  });
  </script>
  
  <style scoped>
  .ending-screen {
    text-align: center;
    padding: 30px;
    background-color: #f9f9f9;
    border-radius: 8px;
    margin: 20px 0;
  }
  
  .ending {
    padding: 20px;
    border-radius: 8px;
    margin-top: 20px;
  }
  
  .icon {
    font-size: 3em;
    margin-bottom: 15px;
  }
  
  .accepted {
    background-color: #e6f7e6;
    border: 1px solid #c3e6cb;
  }
  
  .rejected {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
  }
  
  .blacklisted {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
  }
  </style>