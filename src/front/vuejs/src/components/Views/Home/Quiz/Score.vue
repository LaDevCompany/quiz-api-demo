<script setup lang="ts">
import { computed } from 'vue'
import useQuiz from '@/composables/useQuiz.ts'

const { score } = useQuiz()

const scoring = computed(() => {
  const dots = []

  if (score.easy === null) dots.push(getEmptyDot())
  else if (score.easy === true) dots.push(getValidDot())
  else dots.push(getInvalidDot())

  if (score.medium === null) dots.push(getEmptyDot())
  else if (score.medium === true) dots.push(getValidDot())
  else dots.push(getInvalidDot())

  if (score.hard === null) dots.push(getEmptyDot())
  else if (score.hard === true) dots.push(getValidDot())
  else dots.push(getInvalidDot())

  return dots
})

const getEmptyDot = () => {
  return '<span class="i-tabler-inner-shadow-top-right text-slate-500 "></span>'
}
const getValidDot = () => {
  return '<span class="i-tabler-inner-shadow-top-right-filled text-green-500"></span>'
}
const getInvalidDot = () => {
  return '<span class="i-tabler-inner-shadow-top-right-filled text-red-500"></span>'
}
</script>

<template>
  <div
    class="absolute text-xs -top-3 -right-1 transition-opacity opacity-75 hover:opacity-100"
    v-html="scoring.join(' ')"
  ></div>
</template>
