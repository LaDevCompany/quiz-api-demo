<script setup lang="ts">
import { computed } from 'vue'
import Score from '@/components/Views/Home/Quiz/Score.vue'

const { question, num, score } = defineProps<{
  question: Question
  num: number
  score: Scoring
}>()

const colorDifficulty = computed(() => {
  switch (question.difficulty) {
    case 3:
    case 4:
      return 'text-amber-500'
    case 5:
    case 6:
      return 'text-red-500'
    default:
      return 'text-blue-500'
  }
})
</script>

<template>
  <p class="relative text-2xl text-center select-none">
    <Score :score="score" />
    <span class="mr-2" :class="[colorDifficulty]">{{ num }}.</span>
    <span>{{ question.title }}</span>
  </p>
</template>
