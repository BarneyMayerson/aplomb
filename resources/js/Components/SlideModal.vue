<script setup>
import { computed } from "vue";
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from "@headlessui/vue";
import { useModal } from "momentum-modal";
import XMarkIcon from "./Icons/XMarkIcon.vue";
import { onMounted, onUnmounted } from "vue";

const props = defineProps({
  maxWidth: {
    type: String,
    default: "2xl",
  },
});

const maxWidthClass = computed(() => {
  return {
    sm: "sm:max-w-sm",
    md: "sm:max-w-md",
    lg: "sm:max-w-lg",
    xl: "sm:max-w-xl",
    "2xl": "sm:max-w-2xl",
  }[props.maxWidth];
});

const { show, close, redirect } = useModal();

onMounted(() => {
  document.body.classList.add("overflow-hidden");
});

onUnmounted(() => {
  document.body.classList.remove("overflow-hidden");
});
</script>

<template>
  <TransitionRoot appear as="template" :show="show">
    <Dialog
      as="div"
      class="relative z-50 text-gray-900 dark:text-gray-100"
      @close="close"
    >
      <TransitionChild
        @after-leave="redirect"
        as="template"
        enter="duration-1000 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-1000 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div
          class="fixed inset-0 bg-black/20 backdrop-blur-sm transition-opacity"
        />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div
          class="flex min-h-full items-center justify-center p-4 text-center"
        >
          <TransitionChild
            as="template"
            enter="duration-1000 ease-out"
            enter-from="opacity-0 -translate-y-full"
            enter-to="translate-0"
            leave="duration-1000 ease-in"
            leave-from="translate-0"
            leave-to="opacity-0 translate-y-full"
          >
            <DialogPanel
              class="sm:w-full transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 text-left align-middle shadow-xl shadow-black transition-all md:px-16 md:py-16"
              :class="maxWidthClass"
            >
              <DialogTitle
                as="h3"
                class="text-center text-2xl font-medium leading-6"
              >
                <slot name="title" />
              </DialogTitle>
              <slot />
              <div class="absolute right-0 top-0 pr-4 pt-4">
                <button
                  type="button"
                  class="rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                  @click="close"
                >
                  <span class="sr-only">Close</span>
                  <XMarkIcon class="h-6 w-6" />
                </button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
