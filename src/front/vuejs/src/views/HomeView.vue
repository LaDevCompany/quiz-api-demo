<script setup lang="ts">
import { ref } from 'vue'
import HeroIdle from '@/components/Views/Home/HeroIdle.vue'
import StartingQuiz from '@/components/Views/Home/StartingQuiz.vue'
import EndedQuiz from '@/components/Views/Home/EndedQuiz.vue'
import Quiz from '@/components/Views/Home/Quiz.vue'
import { useTitle } from '@vueuse/core'

const title = useTitle()
title.value = 'Daily Quiz - le quiz du jour ✨'

const state = ref<'idle' | 'starting' | 'started' | 'ended'>('idle')
</script>

<template>
  <main class="container w-full px-2 lg:px-0 my-4 lg:my-1">
    <Quiz v-if="state === 'started'" @ended="state = 'ended'" />
    <StartingQuiz v-else-if="state === 'starting'" @start="state = 'started'" />
    <EndedQuiz v-else-if="state === 'ended'" @start="state = 'started'" />
    <HeroIdle v-else @start="state = 'starting'" />
  </main>
</template>
