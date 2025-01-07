<script setup lang="ts">
import { version } from '@/../package.json'
</script>

<template>
  <footer
    class="flex flex-col-reverse md:flex-row justify-between items-center w-full px-4 py-5 md:px-10 lg:px-20 gap-2 sm:gap-6 bg-slate-100 dark:bg-slate-800"
  >
    <p class="flex gap-2 text-slate-500 dark:text-slate-300">
      <span>&copy; {{ new Date().getFullYear() }} - La Dev Company</span>
    </p>

    <div
      class="grid grid-cols-3 justify-center gap-2 text-center text-slate-500 dark:text-slate-300 text-sm"
    >
      <span>Autres sites : </span>
      <a href="https://quiz-api.com" target="_blank">Quiz API</a>
      <a href="https://quick-poker.fr" target="_blank">Quick Poker</a>
      <a href="https://meilleur-ecran.fr" target="_blank">Meilleur écran fr</a>
      <a href="https://histor-ia.fr/" target="_blank">Historia</a>
    </div>

    <div class="flex flex-row justify-center gap-2 text-center text-slate-500 dark:text-slate-300">
      <RouterLink to="/about" class="hover:text-slate-700 dark:hover:text-slate-100"
        >À propos</RouterLink
      >
      <span class="text-slate-400 dark:text-slate-200"> - {{ version }}</span>
    </div>
  </footer>
</template>
