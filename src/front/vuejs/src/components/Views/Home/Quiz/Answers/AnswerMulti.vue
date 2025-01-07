<script setup lang="ts">
import AnswerClassic from '@/components/Views/Home/Quiz/Answers/Components/AnswerClassic.vue'
import { inject } from 'vue'

const emit = defineEmits(['answer'])
const { chosenAnswer, setChosenAnswer } = inject<{
  chosenAnswer: string[]
  setChosenAnswer: (answer: string[]) => void
}>('chosenAnswer')
const questionState = inject<QuestionState>('questionState')

const { answers } = defineProps<{
  answers: AnswerClassic[]
}>()

const getStatus = (answer: AnswerClassic): AnswerClassicStatus => {
  if (chosenAnswer.value === null) {
    return 'indeterminate'
  }

  if (['guessing', 'answered'].includes(questionState.value)) {
    return chosenAnswer.value.includes(answer.id) ? 'selected' : 'indeterminate'
  }

  if (answer.isValid && chosenAnswer.value.includes(answer.id)) {
    return 'valid'
  } else if (answer.isValid && !chosenAnswer.value.includes(answer.id)) {
    return 'missed'
  } else if (!answer.isValid && chosenAnswer.value.includes(answer.id)) {
    return 'invalid'
  }

  return 'disable'
}

const send = (id: string) => {
  let currentAnswersId = [...(chosenAnswer.value ?? [])]

  if (currentAnswersId.includes(id)) {
    currentAnswersId = currentAnswersId.filter((answerId) => answerId !== id)
  } else {
    currentAnswersId.push(id)
  }

  emit('answer', currentAnswersId)

  setChosenAnswer(currentAnswersId)
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
