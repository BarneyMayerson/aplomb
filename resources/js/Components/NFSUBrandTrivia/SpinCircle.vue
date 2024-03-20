<script setup>
defineProps({
  pulseDuration: {
    type: Number,
    default: 2,
  },
  rotateDuration: {
    type: Number,
    default: 2,
  },
  opacityValues: {
    type: String,
    default: "0;1;0",
  },
});
</script>
<template>
  <svg class="h-14 w-14">
    <circle
      class="text-gray-500"
      fill="transparent"
      stroke-width="6"
      stroke="currentColor"
      r="21"
      cx="28"
      cy="28"
      stroke-dasharray="29,4"
    />
    <animate
      attributeName="stroke-dashoffset"
      :dur="rotateDuration"
      autoplay="true"
      repeatCount="indefinite"
      values="0;264"
    />

    <animate
      attributeName="opacity"
      :values="opacityValues"
      :dur="pulseDuration"
      repeatCount="indefinite"
    />
  </svg>
</template>
