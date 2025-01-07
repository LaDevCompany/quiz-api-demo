<script setup lang="ts">
import { computed } from 'vue'
import Loader from '@/components/UI/Loader.vue'

const {
  type = 'button',
  size = 'md',
  loading = false,
  disabled = false,
} = defineProps<{
  type?: 'button' | 'submit' | 'a'
  size?: 'sm' | 'md' | 'lg'
  loading?: boolean
  disabled?: boolean
}>()

const isDisabled = computed(() => loading || disabled)

const sizeClass = computed(() => {
  switch (size) {
    case 'sm':
      return 'text-xs px-2 py-1.5' + (isDisabled.value ? '' : ' active:pt-2 active:pb-1')
    case 'md':
      return 'px-4 py-2' + (isDisabled.value ? '' : ' active:pt-2.5 active:pb-1.5')
    case 'lg':
      return 'text-xl px-6 py-3' + (isDisabled.value ? '' : ' active:(pt-4 pb-2)')
  }
})
</script>

<template>
  <component
    :is="(type !== 'a' && 'button') || 'a'"
    class="relative inline-flex items-center justify-center rounded-md transition-all duration-125 ease-out ring-inset focus:ring-4 bg-blue-400 hover:bg-blue-500 text-white"
    :class="[
      {
        'opacity-80': isDisabled,
      },
      sizeClass,
    ]"
    :type="(type !== 'a' && type) || undefined"
    :disabled="isDisabled"
    :aria-busy="loading"
  >
    <slot v-if="!loading"></slot>
    <span v-else class="flex justify-center items-center">
      <slot name="loading">
        <div class="relative">
          <span class="invisible"><slot /></span>
          <span class="flex absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <Loader class="w-5" />
          </span>
        </div>
      </slot>
    </span>
  </component>
</template>
