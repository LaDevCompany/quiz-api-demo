<script setup lang="ts">
import { computed, provide, ref } from 'vue'
import testData from '@/../tests/fixtures/question-solo.json'
import testData2 from '@/../tests/fixtures/question-multi.json'
import testData3 from '@/../tests/fixtures/question-pattern.json'

import QuestionComponent from '@/components/Views/Home/Quiz/Question.vue'
import Card from '@/components/UI/Card.vue'
import Answers from '@/components/Views/Home/Quiz/Answers.vue'
import useQuiz from '@/composables/useQuiz.ts'
import Btn from '@/components/UI/Btn.vue'

const emit = defineEmits(['ended'])

const { score, isValid } = useQuiz()

let question: Question = testData2 as Question
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

const answered = (answer: string | string[]) => {
  chosenAnswer.value = answer
  state.value = 'answered'

  // if question solo, no button => answer directly
  if (['solo', 'pattern'].includes(question.type)) {
    validation()
    return
  }
}

const validation = () => {
  if (chosenAnswer.value !== null) {
    state.value = 'validated'
    score[currentDifficulty()] = isValid(question, chosenAnswer.value)
  }
}

const goNext = () => {
  chosenAnswer.value = null

  if (num.value >= 3) {
    emit('ended')
    return
  }

  question = { ...testData3 } as Question
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
  <Card class="flex flex-col gap-3">
    <QuestionComponent :question="question" :num="num" :score="score" />
    <hr />
    <Answers :question="question" @answer="answered" />
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
</template>
