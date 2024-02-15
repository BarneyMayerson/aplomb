<script setup>
import { useModal } from "momentum-modal";
import { computed, onMounted, onUnmounted } from "vue";
import XMarkIcon from "@/Components/Icons/XMarkIcon.vue";

const emit = defineEmits(["close"]);

const close = () => emit("close");

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

const { show } = useModal();

const closeOnEscape = (e) => {
  if (e.key === "Escape" && show) {
    close();
  }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));

onUnmounted(() => {
  document.removeEventListener("keydown", closeOnEscape);
  document.body.style.overflow = null;
});
</script>

<template>
  <Transition>
    <div
      v-show="show"
      class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    >
      <Transition
        enter-active-class="ease-out duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="ease-in duration-200"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <div
          v-show="show"
          class="fixed inset-0 transform transition-all"
          @click="close"
        >
          <div class="absolute inset-0 backdrop-blur-sm bg-black/30" />
        </div>
      </Transition>

      <div class="flex min-h-full items-center eas">
        <Transition
          enter-active-class="ease-linear duration-1000"
          enter-from-class="opacity-0 translate-y-full"
          enter-to-class="opacity-100 translate-y-0"
          leave-active-class="ease-linear duration-1000"
          leave-from-class="opacity-100 translate-0"
          leave-to-class="opacity-0 -translate-y-full"
        >
          <div
            v-show="show"
            class="mb-6 text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto"
            :class="maxWidthClass"
          >
            <div class="absolute right-0 top-0 pr-4 pt-4">
              <button
                type="button"
                class="rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                @click="close"
              >
                <span class="sr-only">Close</span>
                <XMarkIcon
                  ref="closeButtonRef"
                  class="h-6 w-6 focus:outline-none"
                />
              </button>
            </div>
            <slot v-if="show" />
          </div>
        </Transition>
      </div>
    </div>
  </Transition>
</template>
