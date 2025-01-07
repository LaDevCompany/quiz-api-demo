<script setup lang="ts">
import AnswerClassic from '@/components/Views/Home/Quiz/Answers/Components/AnswerClassic.vue'
import { inject } from 'vue'

const emit = defineEmits(['answer'])
const { chosenAnswer, setChosenAnswer } = inject<{
  chosenAnswer: string
  setChosenAnswer: (answer: string) => void
}>('chosenAnswer')

const { answers } = defineProps<{
  answers: AnswerClassic[]
}>()

const getStatus = (answer: AnswerClassic): AnswerClassicStatus => {
  if (chosenAnswer.value === null) {
    return 'indeterminate'
  }

  // if valid and chosen
  if (chosenAnswer.value === answer.id && answer.isValid) {
    return 'valid'
  }
  // if not valid and chosen
  else if (chosenAnswer.value === answer.id && !answer.isValid) {
    return 'invalid'
  }
  // if not chosen but valid
  else if (chosenAnswer.value !== answer.id && answer.isValid) {
    return 'valid'
  }

  return 'disable'
}

const send = (id: string) => {
  emit('answer', id)

  setChosenAnswer(id)
}
</script>

<template>
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
    <AnswerClassic
      v-for="answer in answers"
      :answer="answer"
      :status="getStatus(answer)"
      @send="send"
    />
  </div>
</template>
