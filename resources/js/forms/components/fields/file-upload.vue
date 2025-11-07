<template>
  <div class="relative">
    <div
      :class="[
        'flex items-stretch border-2 py-4 pr-4',
        error ? 'border-red-600' : 'border-black'
      ]">
      <input
        :id="name"
        ref="fileInput"
        type="file"
        :name="name"
        :multiple="allowMultiple"
        :accept="acceptedFileTypes"
        :required="required"
        @change="handleFileChange"
        class="hidden"
      />
      <div class="flex-1 px-5 py-6 bg-white text-xs sm:text-sm">
        <span :class="error ? 'text-red-600' : 'text-black'">
          {{ error || displayLabel }}
        </span>
      </div>
      <label
        :for="name"
        class="text-xs md:text-sm cursor-pointer px-10 md:px-20 py-6 bg-greylon text-black hover:bg-vionex hover:text-white transition-colors flex items-center justify-center whitespace-nowrap">
        Datei auswählen
      </label>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
  modelValue: {
    type: Array,
    default: () => []
  },
  name: {
    type: String,
    required: true
  },
  label: {
    type: String,
    default: ''
  },
  error: {
    type: String,
    default: ''
  },
  required: {
    type: Boolean,
    default: false
  },
  allowMultiple: {
    type: Boolean,
    default: false
  }
});

const emit = defineEmits(['update:modelValue', 'update:error']);

const acceptedFileTypes = 'image/png,image/jpeg,image/jpg,application/pdf,application/zip';

const fileLabel = computed(() => {
  const files = props.modelValue || [];
  if (files.length === 0) {
    return 'Keine Datei ausgewählt';
  }
  if (files.length === 1) {
    return files[0].name;
  }
  return `${files.length} Dateien ausgewählt`;
});

const displayLabel = computed(() => {
  const files = props.modelValue || [];
  if (files.length === 0) {
    return props.label;
  }
  if (files.length === 1) {
    return files[0].name;
  }
  return `${files.length} Dateien ausgewählt`;
});

const fileInput = ref(null);

const handleFileChange = (event) => {
  const files = Array.from(event.target.files || []);
  emit('update:modelValue', files);
  // Clear error when files are selected
  if (files.length > 0) {
    emit('update:error', '');
  } else {
    // Reset input if no files selected (user cancelled)
    if (fileInput.value) {
      fileInput.value.value = '';
    }
  }
};
</script>
