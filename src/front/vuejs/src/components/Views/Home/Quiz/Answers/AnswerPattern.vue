<script setup lang="ts">
import {
  inject,
  computed,
  useTemplateRef,
  type InputHTMLAttributes,
  onMounted,
  onUpdated,
} from 'vue'
import Btn from '@/components/UI/Btn.vue'

const emit = defineEmits(['answer'])
const questionState = inject<QuestionState>('questionState')

const { answers } = defineProps<{
  answers: AnswerPattern[]
}>()

const input = useTemplateRef<InputHTMLAttributes>('input')
const answer = defineModel<string>('')

const isDisabled = computed(() => ['validated'].includes(questionState.value))

const send = () => {
  emit('answer', answer.value)
}

onMounted(() => {
  input.value.focus()
})
onUpdated(() => {
  input.value.focus()
})
</script>

<template>
  <form @submit.prevent="send" class="grid grid-cols-1 lg:grid-cols-2 gap-3">
    <div>
      <input
        ref="input"
        v-model="answer"
        type="text"
        placeholder="✨️  Tapez la réponse ..."
        class="w-full h-full text-lg border-1 border-solid border-zinc-400 rounded-md py-2 px-4"
        :disabled="isDisabled"
      />
    </div>
    <div>
      <Btn type="submit" class="w-full" :disabled="isDisabled">Valider</Btn>
    </div>
  </form>
</template>
