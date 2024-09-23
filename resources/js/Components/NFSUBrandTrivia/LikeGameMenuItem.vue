<script setup>
import { computed, ref } from "vue";
import { Link } from "@inertiajs/vue3";

defineProps({
  href: {
    type: String,
    required: true,
  },
});

const hovered = ref(false);

const containerClasses = computed(() =>
  hovered.value
    ? "border-b-[12px] border-t-[12px] border-gray-300"
    : "py-[12px]",
);
</script>

<template>
  <div class="relative h-16 text-nowrap" :class="containerClasses">
    <div v-if="hovered">
      <div
        class="absolute -left-[6px] -top-[12px] h-[12px] w-[12px] skew-x-[45deg] bg-gray-300"
      ></div>
      <div
        class="absolute -left-[6px] -bottom-[12px] h-[12px] w-[12px] -skew-x-[45deg] bg-gray-300"
      ></div>
      <div
        class="animate-blinking absolute -right-[21px] -top-[3px] -my-2.5 h-[66px] w-5 bg-gray-500"
      ></div>
    </div>

    <Link
      :href="href"
      @focusin="hovered = true"
      @focusout="hovered = false"
      @mouseover="hovered = true"
      @mouseleave="hovered = false"
      class="flex w-full justify-end pr-2 font-sans font-semibold text-3xl uppercase italic tracking-wide text-sky-400 hover:text-gray-300 focus:text-gray-300 focus:outline-none"
    >
      <slot></slot>
    </Link>
  </div>
</template>

<style scoped>
.animate-blinking {
  -webkit-animation: animate-blinking 1s infinite;
  animation: animate-blinking 1s infinite;
}

@-webkit-keyframes animate-blinking {
  0%,
  49% {
    opacity: 0.1;
  }
  50%,
  100% {
    opacity: 1;
  }
}
@keyframes animate-blinking {
  0%,
  49% {
    opacity: 0.1;
  }
  50%,
  100% {
    opacity: 1;
  }
}
</style>
