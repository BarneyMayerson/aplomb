<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  href: String,
  active: Boolean,
});

const classes = computed(() => {
  return props.active
    ? "w-full text-gray-700 hover:text-gray-900 dark:text-gray-500 dark:hover:text-gray-300 bg-gray-200 dark:bg-gray-800 px-4 py-2 rounded"
    : "w-full text-gray-700 hover:text-gray-900 dark:text-gray-500 dark:hover:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800 px-4 py-2 rounded";
});
</script>

<template>
  <Link :href :class="classes">
    <slot />
  </Link>
</template>
