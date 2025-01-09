<script setup lang="ts">
import Card from '@/components/UI/Card.vue'
import Btn from '@/components/UI/Btn.vue'
import { ref } from 'vue'

const emit = defineEmits(['start'])

const showHelper = ref(false)
</script>

<template>
  <Transition appear name="bounce">
    <Card class="flex flex-col !py-12 gap-2 text-center text-slate-8 dark:text-slate-3 shadow-2xl">
      <h1 class="text-4xl font-bold">✨ Bienvenue sur Daily Quiz !</h1>

      <p class="text-xl text-slate-500">
        Chaque jour une série de trois questions différentes ! Défiez votre famille et vos amis !
      </p>

      <div class="mt-12 flex justify-center gap-2">
        <Btn class="transition-all" size="lg" @click="emit('start')">Commencer !</Btn>
        <span v-show="!showHelper" tabindex="0" class="helper" size="lg" @click="showHelper = true"
          >?</span
        >
      </div>

      <Transition name="slide-down">
        <p v-show="showHelper" class="mt-4 text-slate-500 lg:px-24">
          Cette mini application sert de démo à l'utilisation de
          <a href="https://quiz-api.com">Quiz Api</a>, service de base de données de questions,
          permettant de créer vous même des jeux et des applications de quiz simplement et
          rapidement !<br /><br />Le code source de cette démo est open source, consultable
          librement sur
          <a href="https://github.com/LaDevCompany/quiz-api-demo" rel="noopener nofollow">Github</a
          >, ça vous permet de démarrer sereinement votre app avec <strong>Quiz API</strong>
        </p>
      </Transition>
    </Card>
  </Transition>
</template>

<style scoped>
@keyframes helper-appear {
  0% {
    width: 0;
  }
  100% {
    width: 60px;
  }
}

.helper {
  @apply w-0 flex justify-center items-center text-2xl rounded-full transition-colors duration-500 bg-zinc-100 text-blue-400 hover:(bg-blue-100 text-blue-600 border-3 border-solid border-blue-400) cursor-pointer overflow-hidden transform-cpu animate-forwards;
  animation-name: helper-appear;
  animation-duration: 1s;
  animation-delay: 5s;
}
</style>
