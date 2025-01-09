<script setup lang="ts">
import Card from '@/components/UI/Card.vue'
import { onMounted, ref, watch } from 'vue'
import { useIntervalFn } from '@vueuse/core'
import useQuiz from '@/composables/useQuiz.ts'

const emit = defineEmits(['start'])

const { fetchQuestions, questions } = useQuiz()

const timer = ref(3)

const { pause } = useIntervalFn(() => {
  --timer.value
}, 1000)

watch(timer, () => {
  if (timer.value <= 0) {
    pause()
    emit('start')
  }
})

onMounted(() => {
  fetchQuestions()
})
</script>

<template>
  <Card
    class="flex flex-col !py-12 gap-2 text-center text-slate-8 dark:text-slate-3 shadow-2xl overflow-hidden"
  >
    <h1 class="text-4xl font-bold">✨ Le quiz du jour démarre dans :</h1>

    <p id="number-animation" class="text-4xl text-blue-300 mt-6">{{ timer }} ...</p>

    <p v-if="timer <= 0 && questions.length === 0">
      Une erreur est survenue lors de la récupération des questions, réessayez demain !
    </p>
  </Card>
</template>

<style scoped>
#number-animation {
  animation: scaleInOut 1s infinite;
  animation-timing-function: ease;
}

@keyframes scaleInOut {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(2);
  }
  100% {
    transform: scale(1);
  }
}
</style>
