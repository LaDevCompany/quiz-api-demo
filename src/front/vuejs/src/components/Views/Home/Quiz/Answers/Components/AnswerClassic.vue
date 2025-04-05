<script setup lang="ts">
import { computed } from 'vue'
import useQuiz from '@/composables/useQuiz.ts'

const emit = defineEmits(['send'])

const { state: questionState } = useQuiz()

const { answer, status = 'indeterminate' } = defineProps<{
  answer: AnswerClassic
  status: AnswerClassicStatus
}>()

const colorBg = computed(() => {
  if (questionState.value === 'validated') {
    switch (status) {
      case 'valid':
        return 'bg-green-500 text-green-950 !border-green-600'
      case 'invalid':
        return 'bg-red-500 text-red-950 !border-red-700'
      case 'disable':
        return 'bg-slate-50 text-slate-600'
      case 'missed':
        return 'text-green-600 !border-green-600'
    }
  } else if (questionState.value === 'answered' && status === 'selected') {
    return 'cursor-pointer text-blue-600 !border-blue-600'
  }

  return 'bg-white cursor-pointer hover:(pl-8 bg-blue-200 text-blue-900 border-blue-500)'
})

const send = () => {
  if (['guessing', 'answered'].includes(questionState.value)) {
    emit('send', answer.id)
  }
}
</script>

<template>
  <div
    class="border-5 border-solid border-zinc-3 rounded-2 px-6 py-4 text-center shadow transition-all duration-400 text-lg select-none"
    :class="[colorBg]"
    @click="send"
    @keyup.enter.space="send"
    tabindex="0"
  >
    {{ answer.title }}
  </div>
</template>
