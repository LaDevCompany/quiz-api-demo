<script setup lang="ts">
import { computed } from 'vue'

const { question, num } = defineProps<{
  question: Question
  num: number
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
  <p class="text-2xl text-center select-none">
    <span class="mr-2" :class="[colorDifficulty]">{{ num }}.</span>
    <span>{{ question.title }}</span>
  </p>
</template>
