<template>
    <div class="progress-container">
      <div class="progress-bar">
        <div class="progress-fill" :style="{ width: `${progress}%` }"></div>
      </div>
      <div class="progress-text">{{ progress }}% complété</div>
    </div>
  </template>
  
  <script setup>
  import { computed } from 'vue';
  
  const props = defineProps({
    current: {
      type: Number,
      required: true
    },
    total: {
      type: Number,
      required: true
    }
  });
  
  const progress = computed(() => {
    if (props.total === 0) return 0;
    return Math.round((props.current / props.total) * 100);
  });
  </script>
  
  <style scoped>
  .progress-container {
    margin: 20px 0;
  }
  
  .progress-bar {
    height: 8px;
    background-color: #f0f0f0;
    border-radius: 4px;
    overflow: hidden;
  }
  
  .progress-fill {
    height: 100%;
    background-color: #4CAF50;
    transition: width 0.5s ease;
  }
  
  .progress-text {
    margin-top: 5px;
    text-align: right;
    font-size: 0.8em;
    color: #666;
  }
  </style>