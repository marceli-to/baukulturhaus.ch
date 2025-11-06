<template>
  <div class="relative">
    <input
      :type="type"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      @focus="$emit('update:error', '')"
      :placeholder="placeholder"
      :aria-label="ariaLabel"
      :required="required"
      :class="[
        'w-full px-5 py-8 border-2 border-black focus:outline-none focus:border-vionex !ring-0 placeholder:text-black',
        { 'border-red-600 placeholder:text-red-600': error }
      ]"
    >
  </div>
</template>

<script setup>
const props = defineProps({
  modelValue: {
    type: [String, Number],
    default: ''
  },
  type: {
    type: String,
    default: 'text'
  },
  placeholder: {
    type: String,
    default: ''
  },
  label: {
    type: String,
    default: ''
  },
  ariaLabel: {
    type: String,
    default: ''
  },
  required: {
    type: Boolean,
    default: false
  },
  error: {
    type: String,
    default: ''
  },
});

defineEmits(['update:modelValue', 'update:error']);
</script>
