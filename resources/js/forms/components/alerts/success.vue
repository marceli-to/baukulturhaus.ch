<template>
  <div v-if="visible" class="bg-green-600 text-white text-center py-5 lg:py-10 mb-10 lg:mb-20">
    <slot></slot>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const visible = ref(true);

onMounted(() => {
  setTimeout(() => {
    visible.value = false;
  }, 5000);
});
</script>
