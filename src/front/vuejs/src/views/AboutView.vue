<script setup lang="ts">
import Card from '@/components/UI/Card.vue'
import Btn from '@/components/UI/Btn.vue'
import { useTitle } from '@vueuse/core'

const title = useTitle()
title.value = 'Daily Quiz - à propos'

const quizApiUrl = import.meta.env.VITE_QUIZAPI_URL
</script>

<template>
  <main class="container w-full px-2 lg:px-0 my-4 lg:my-1">
    <Card
      class="flex flex-col !py-12 !px-12 gap-2 text-slate-8 dark:text-slate-3 shadow-2xl overflow-hidden"
    >
      <h1 class="text-4xl font-bold text-center">Daily Quiz - à propos</h1>

      <h2 class="text-2xl font-bold mt-4">Daily Quiz</h2>
      <p>
        Daily Quiz est une mini app qui permet de faire une démonstration de l'utilisation de
        <a :href="quizApiUrl" target="_blank">Quiz Api</a>, service de base de données de questions,
        permettant de créer vous même des jeux et des applications de quiz simplement et rapidement
      </p>
      <p>
        Le code source de cette démo est open source, consultable librement sur
        <a
          href="https://github.com/LaDevCompany/quiz-api-demo"
          rel="noopener nofollow"
          target="_blank"
          >Github</a
        >.
      </p>

      <h2 class="text-2xl font-bold mt-4">Vie Privée</h2>
      <p>Daily Quiz n'utilise pas de cookie ou de système de tracking.</p>

      <h2 class="text-2xl font-bold mt-4">Crédits</h2>
      <p>
        Free SVG Background by
        <a target="_blank" rel="noopener nofollow" href="https://bgjar.com">BGJar</a>
      </p>

      <div class="text-right">
        <Btn type="a" href="/">Retour</Btn>
      </div>
    </Card>
  </main>
</template>
