<script setup lang="ts">
defineOptions({
  inheritAttrs: false,
})
</script>

<template>
  <div class="py-2 px-2 bg-zinc-2/75 rounded-2">
    <div class="rounded-1 bg-white px-2 py-4" v-bind="$attrs">
      <slot />
    </div>
  </div>
</template>
