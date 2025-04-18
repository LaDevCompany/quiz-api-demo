<script setup lang="ts">
import Card from '@/components/UI/Card.vue'
import useQuiz from '@/composables/useQuiz.ts'
import { computed } from 'vue'
import { useWebNotification } from '@vueuse/core'

const { score } = useQuiz()

const scoreNb = computed(() => {
  return (score.easy ? 1 : 0) + (score.medium ? 1 : 0) + (score.hard ? 1 : 0)
})

const endingText = computed(() => {
  switch (scoreNb.value) {
    case 1:
      return 'Pas mal !'
    case 2:
      return 'Joli !'
    case 3:
      return 'Incroyable !'
    default:
      return '?'
  }
})

const copy = () => {
  navigator.clipboard.writeText(document.location.href).then(
    function () {
      const { show } = useWebNotification({
        title: 'Lien copié, partagez le à votre famille et vos amis !',
        dir: 'auto',
        lang: 'fr',
      })

      show()
    },
    function (err) {
      console.error('Async: Could not copy text: ', err)
    },
  )
}

const quizApiUrl = import.meta.env.VITE_QUIZAPI_URL
</script>

<template>
  <Transition appear name="bounce">
    <Card
      class="relative flex flex-col !py-12 gap-6 text-center text-slate-800 dark:text-slate-300 shadow-2xl overflow-hidden"
    >
      <h1 class="text-4xl font-bold md:hidden flex flex-col gap-5">
        <span class="text-6xl">Bravo !</span
        ><span class="text-blue-400">Le quiz du jour est terminé !</span>
      </h1>
      <h1 class="text-4xl font-bold hidden md:block">Bravo ! Le quiz du jour est terminé !</h1>

      <div class="mt-2 flex justify-center gap-3">
        <span
          class="dot dot-easy i-tabler-inner-shadow-top-right-filled"
          :class="[score.easy ? 'text-blue-400' : 'text-red-500']"
        ></span>
        <span
          class="dot dot-medium i-tabler-inner-shadow-top-right-filled"
          :class="[score.medium ? 'text-blue-400' : 'text-red-500']"
        ></span>
        <span
          class="dot dot-hard i-tabler-inner-shadow-top-right-filled"
          :class="[score.hard ? 'text-blue-400' : 'text-red-500']"
        ></span>
      </div>

      <p v-if="scoreNb > 0" class="fade-second text-3xl flex justify-center items-center gap-3">
        <span class="text-slate-800">{{ scoreNb }} / 3</span>
        <span>-</span>
        <span class="text-blue-400">{{ endingText }}</span>
      </p>

      <p class="fade-see-you text-slate-400 mb-4 sm:mb-0">A demain pour un nouveau quiz 🥰</p>

      <p class="fade-last absolute p-2 left-5 bottom-2 text-xs">
        Powered by <a :href="quizApiUrl" target="_blank">Quiz API</a>
      </p>

      <p
        tabindex="0"
        title="Partager le Quiz !"
        class="fade-last absolute flex p-2 right-5 bottom-5 bg-zinc-100 rounded-full transition-all cursor-pointer opacity-85 hover:(-translate-y-1 opacity-100) active:(scale-80)"
        @click="copy"
      >
        <span class="i-tabler-link" />
      </p>
    </Card>
  </Transition>
</template>

<style scoped>
@keyframes dot-appear {
  0% {
    opacity: 0;
    transform: translateY(-50px) scale(0.5);
  }
  70% {
    transform: translateY(0) scale(1.2);
  }
  100% {
    opacity: 100%;
    transform: translateY(0) scale(1);
  }
}

.dot {
  @apply opacity-0 text-3xl transform-cpu animate-forwards;
  animation-name: dot-appear;
  animation-duration: 1s;
  animation-timing-function: ease;
}
.dot-easy {
  animation-delay: 0.5s;
}
.dot-medium {
  animation-delay: 1.5s;
}
.dot-hard {
  animation-delay: 2.5s;
}

@keyframes fade-appear {
  from {
    opacity: 0;
  }
  to {
    opacity: 100%;
  }
}

.fade-second {
  @apply opacity-0 transform-cpu animate-forwards;
  animation-name: fade-appear;
  animation-duration: 1s;
  animation-timing-function: ease;
  animation-delay: 3.5s;
}

.fade-see-you {
  @apply opacity-0 transform-cpu animate-forwards;
  animation-name: fade-appear;
  animation-duration: 1s;
  animation-timing-function: ease;
  animation-delay: 4.5s;
}

.fade-last {
  @apply opacity-0 transform-cpu animate-forwards;
  animation-name: fade-appear;
  animation-duration: 1s;
  animation-timing-function: ease;
  animation-delay: 5.5s;
}
</style>
