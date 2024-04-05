<script setup>
import { computed } from "vue";

const props = defineProps({
  alignRight: {
    type: Boolean,
    required: true,
  },
  message: {
    type: Object,
    required: true,
  },
});

const classes = computed(() => {
  return props.alignRight
    ? "mb-3 w-5/6 float-right bg-gray-100 dark:bg-gray-950 border border-gray-300 dark:border-gray-800 rounded-lg px-4 py-2"
    : "mb-3 w-5/6 bg-gray-100 dark:bg-gray-950 border border-gray-300 dark:border-gray-800 rounded-lg px-4 py-2";
});
</script>

<template>
  <div :class="classes">
    {{ message.text }}
    <span
      class="block text-xs font-semibold text-gray-500 dark:text-gray-400 text-right"
    >
      {{ message.created_at }}
    </span>
  </div>
</template>
