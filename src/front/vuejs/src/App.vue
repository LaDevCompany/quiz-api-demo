<script setup lang="ts">
import { RouterView } from 'vue-router'
import Header from '@/components/Common/Header.vue'
import Footer from '@/components/Common/Footer.vue'
</script>

<template>
  <Header />

  <RouterView />

  <Footer />
</template>
