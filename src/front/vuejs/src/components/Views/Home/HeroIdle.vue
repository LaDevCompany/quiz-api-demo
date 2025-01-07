<script setup lang="ts">
import Card from '@/components/UI/Card.vue'
import Btn from '@/components/UI/Btn.vue'

const emit = defineEmits(['start'])
</script>

<template>
  <Transition appear name="bounce">
    <Card class="flex flex-col !py-12 gap-2 text-center text-slate-8 dark:text-slate-3 shadow-2xl">
      <h1 class="text-4xl font-bold">✨ Bienvenue sur Daily Quiz !</h1>

      <p class="text-xl text-slate-500">
        Chaque jour une série de trois questions différentes ! Défiez votre famille et vos amis !
      </p>

      <div class="mt-12">
        <Btn size="lg" @click="emit('start')">Commencer !</Btn>
      </div>
    </Card>
  </Transition>
</template>
