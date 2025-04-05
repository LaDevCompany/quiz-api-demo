<script setup lang="ts">
import { computed, useTemplateRef, nextTick } from 'vue'
import Btn from '@/components/UI/Btn.vue'
import { watchImmediate } from '@vueuse/core'
import useQuiz from '@/composables/useQuiz.ts'

const emit = defineEmits(['answer'])

const { answers } = defineProps<{
  answers: AnswerPattern
}>()
const answer = defineModel<string>()

const { state: questionState, isValidPattern } = useQuiz()

const input = useTemplateRef<HTMLInputElement>('input')

const isDisabled = computed(() => ['validated'].includes(questionState.value ?? 'guessing'))

const inputColors = computed(() => {
  if (questionState.value === 'validated') {
    return isValidPattern(answers, answer.value ?? '')
      ? 'border-green-400 bg-green-200'
      : 'border-red-400 bg-red-200'
  }

  return 'border-zinc-400'
})

const send = () => {
  emit('answer', answer.value)
}

watchImmediate(questionState, (newState) => {
  if (newState === 'guessing') {
    nextTick(() => {
      if (input.value != undefined) {
        input.value.focus()
        input.value.value = ''
        answer.value = ''
      }
    })
  }
})
</script>

<template>
  <form @submit.prevent="send">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
      <div>
        <input
          ref="input"
          v-model="answer"
          type="text"
          placeholder="✨️  Tapez la réponse ..."
          class="w-full h-full text-lg border-1 border-solid rounded-md py-2 px-4"
          :class="[inputColors]"
          :disabled="isDisabled"
        />
      </div>
      <div>
        <Btn type="submit" class="w-full" :disabled="isDisabled">Valider</Btn>
      </div>
    </div>

    <Transition>
      <div v-show="questionState === 'validated'" class="text-2xl text-center mt-6">
        {{ answers.title }}
      </div>
    </Transition>
  </form>
</template>
