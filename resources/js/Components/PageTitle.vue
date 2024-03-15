<script setup>
import { Head } from "@inertiajs/vue3";

defineProps({
  title: String,
});
</script>

<template>
  <Head :title="title" id="head" />
  <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h2
      class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
    >
      {{ title }}
    </h2>
  </div>
</template>
