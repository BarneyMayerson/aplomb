<script setup>
import SlideModal from "@/Components/SlideModal.vue";

defineProps({
  maxWidth: {
    type: String,
    default: "2xl",
  },
  dialogTitle: {
    type: String,
    default: "Dialog Title",
  },
});
</script>

<template>
  <SlideModal :maxWidth="maxWidth">
    <template #title>{{ dialogTitle }}</template>

    <div class="mt-8 text-gray-600 dark:text-gray-400">
      <slot name="content" />
    </div>
    <div class="mt-8">
      <div class="flex flex-row justify-end text-end">
        <slot name="footer" />
      </div>
    </div>
  </SlideModal>
</template>
