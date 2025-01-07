<script setup lang="ts">
import { ref } from 'vue'
import HeroIdle from '@/components/Views/Home/HeroIdle.vue'
import StartingQuiz from '@/components/Views/Home/StartingQuiz.vue'
import Quiz from '@/components/Views/Home/Quiz.vue'

const state = ref<'idle' | 'starting' | 'started'>('idle')
</script>

<template>
  <main class="container w-full px-2 lg:px-0 my-4 lg:my-1">
    <Quiz v-if="state === 'started'" />
    <StartingQuiz v-else-if="state === 'starting'" @start="state = 'started'" />
    <HeroIdle v-else @start="state = 'starting'" />
  </main>
</template>
