<script setup lang="ts">
import { computed, provide, ref } from 'vue'

import QuestionComponent from '@/components/Views/Home/Quiz/Question.vue'
import Card from '@/components/UI/Card.vue'
import Answers from '@/components/Views/Home/Quiz/Answers.vue'
import Btn from '@/components/UI/Btn.vue'
import useQuiz from '@/composables/useQuiz.ts'

const emit = defineEmits(['ended'])

const { questions, score, isValid } = useQuiz()

const state = ref<QuestionState>('guessing')
const num = ref(1)
const chosenAnswer = ref<string | string[] | null>(null)

const setChosenAnswer = (answer: string | string[]) => {
  chosenAnswer.value = answer
}

provide('chosenAnswer', {
  chosenAnswer,
  setChosenAnswer,
})
provide('questionState', state)

const currentQuestion = computed<Question | null>(() => {
  if (questions.value[num.value - 1] != null) {
    return questions.value[num.value - 1]
  }

  return null
})

const answered = (answer: string | string[]) => {
  chosenAnswer.value = answer
  state.value = 'answered'

  // if question solo, no button => answer directly
  if (['solo', 'pattern'].includes(currentQuestion.value!.type)) {
    validation()
    return
  }
}

const validation = () => {
  if (chosenAnswer.value !== null) {
    state.value = 'validated'
    score[currentDifficulty()] = isValid(currentQuestion.value!, chosenAnswer.value)
  }
}

const goNext = () => {
  chosenAnswer.value = null

  if (num.value >= 3) {
    emit('ended')
    return
  }

  state.value = 'guessing'
  ++num.value
}

const currentDifficulty = (): Difficulties => {
  return ['easy', 'medium', 'hard'][num.value - 1] as Difficulties
}

const btnLabel = computed(() => {
  return num.value >= 3 ? 'Terminer le Quiz ✨' : 'Prochaine question !'
})
</script>

<template>
  <Card v-if="currentQuestion !== null" class="flex flex-col gap-3">
    <QuestionComponent :question="currentQuestion" :num="num" :score="score" />
    <hr />
    <Answers :question="currentQuestion" @answer="answered" />
    <Transition mode="out-in" name="slide-down">
      <div v-if="state === 'answered'">
        <hr class="mb-4" />
        <Btn size="lg" class="w-full" @click="validation">Valider</Btn>
      </div>
      <div v-else-if="state === 'validated'">
        <hr class="mb-4" />
        <Btn size="lg" class="w-full" @click="goNext">{{ btnLabel }}</Btn>
      </div>
    </Transition>
  </Card>
  <Card v-else class="text-center">Une erreur est survenue, tentez de rafraîchir la page</Card>
</template>
