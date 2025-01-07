<script setup lang="ts">
import { provide, reactive, ref } from 'vue'
import testData from '@/../tests/fixtures/question-solo.json'
import testData2 from '@/../tests/fixtures/question-multi.json'
import testData3 from '@/../tests/fixtures/question-pattern.json'

import QuestionComponent from '@/components/Views/Home/Quiz/Question.vue'
import Card from '@/components/UI/Card.vue'
import Answers from '@/components/Views/Home/Quiz/Answers.vue'
import useQuiz from '@/composables/useQuiz.ts'
import Btn from '@/components/UI/Btn.vue'

const emit = defineEmits()

const { isValid } = useQuiz()

let question: Question = testData as Question
const state = ref<QuestionType>('guessing')
const num = ref(1)
const chosenAnswer = ref<string | string[] | null>(null)
const score = reactive<{
  easy: boolean | null
  medium: boolean | null
  hard: boolean | null
}>({
  easy: null,
  medium: null,
  hard: null,
})

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
  if (question.type === 'solo') {
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

  question = { ...testData2 } as Question
  state.value = 'guessing'
  ++num.value
}

const currentDifficulty = (): Difficulties => {
  return ['easy', 'medium', 'hard'][num.value - 1] as Difficulties
}
</script>

<template>
  <Card class="flex flex-col gap-3">
    <QuestionComponent :question="question" :num="num" />
    <hr />
    <Answers :question="question" @answer="answered" />
    {{ score }} - {{ currentDifficulty() }}
    <Transition mode="out-in" name="slide-down">
      <div v-if="state === 'answered'">
        <hr class="mb-4" />
        <Btn size="lg" class="w-full" @click="validation">Valider</Btn>
      </div>
      <div v-else-if="state === 'validated'">
        <hr class="mb-4" />
        <Btn size="lg" class="w-full" @click="goNext">Prochaine question !</Btn>
      </div>
    </Transition>
  </Card>
</template>
