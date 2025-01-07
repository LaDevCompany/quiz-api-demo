<script setup lang="ts">
import AnswerSolo from '@/components/Views/Home/Quiz/Answers/AnswerSolo.vue'
import AnswerMulti from '@/components/Views/Home/Quiz/Answers/AnswerMulti.vue'
import AnswerPattern from '@/components/Views/Home/Quiz/Answers/AnswerPattern.vue'

const emit = defineEmits(['answer'])

const { question } = defineProps<{
  question: Question
}>()

const doAnswer = (answer: string | string[]) => {
  emit('answer', answer)
}
</script>

<template>
  <template v-if="question.type === 'solo'">
    <AnswerSolo :answers="question.answers as AnswerClassic[]" @answer="doAnswer" />
  </template>
  <template v-else-if="question.type === 'multi'">
    <AnswerMulti :answers="question.answers as AnswerClassic[]" @answer="doAnswer" />
  </template>
  <template v-else-if="question.type === 'pattern'">
    <AnswerPattern :answers="question.answers as AnswerPattern" @answer="doAnswer" />
  </template>
  <template v-else><span>Not Implemented yet ;)</span></template>
</template>
