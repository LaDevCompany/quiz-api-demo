<script setup lang="ts">
import AnswerClassic from '@/components/Views/Home/Quiz/Answers/Components/AnswerClassic.vue'
import { inject, type Ref } from 'vue'

const emit = defineEmits(['answer'])
const { chosenAnswer, setChosenAnswer } = inject<{
  chosenAnswer: Ref<string[]>
  setChosenAnswer: (answer: string[]) => void
}>('chosenAnswer')!
const questionState = inject<Ref<QuestionState>>('questionState')!

const { answers } = defineProps<{
  answers: AnswerClassic[]
}>()

const getStatus = (answer: AnswerClassic): AnswerClassicStatus => {
  if (chosenAnswer.value === null) {
    return 'indeterminate'
  }

  if (['guessing', 'answered'].includes(questionState.value ?? 'guessing')) {
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
  <div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
      <AnswerClassic
        v-for="answer in answers"
        :answer="answer"
        :status="getStatus(answer)"
        @send="send"
      />
    </div>

    <div v-show="questionState === 'guessing'" class="mt-4">
      <hr />
      <p class="mt-6 mb-4 pl-4 text-blue-400">Plusieurs réponses sont possible</p>
    </div>
  </div>
</template>
