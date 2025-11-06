<template>
  <button :type="type" :class="classes" :disabled="disabled">
    <slot></slot>
    {{ label }}
  </button>
</template>
<script setup>
const props = defineProps({
  type: {
    type: String,
    default: 'submit'
  },
  label: {
    type: String,
    required: true
  },
  classes: {
    type: String,
    default: 'w-auto bg-vionex text-white px-5 py-8 pr-40 md:pr-80 border-2 border-vionex focus:outline-none hover:bg-transparent hover:text-vionex active:bg-transparent active:text-vionex !ring-0 transition-colors disabled:opacity-50 disabled:cursor-not-allowed'
  },
  disabled: {
    type: Boolean,
    default: false
  }
});
</script>