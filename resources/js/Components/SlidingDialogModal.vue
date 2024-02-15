<script setup>
import SlidingModal from "@/Components/SlidingModal.vue";

defineProps({
  maxWidth: {
    type: String,
    default: "2xl",
  },
});

defineEmits(["close"]);
</script>

<template>
  <SlidingModal :max-width="maxWidth" @close="$emit('close')">
    <div class="px-6 py-4">
      <div class="text-lg font-medium text-gray-900 dark:text-gray-100 pr-4">
        <slot name="title" />
      </div>

      <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
        <slot name="content" />
      </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 text-end">
      <slot name="footer" />
    </div>
  </SlidingModal>
</template>
