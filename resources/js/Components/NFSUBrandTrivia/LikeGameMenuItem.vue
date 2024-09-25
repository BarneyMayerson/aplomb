<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  href: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <li class="relative h-16 text-nowrap">
    <Link
      :href="href"
      class="flex w-full justify-end pr-2 font-sans font-semibold text-3xl uppercase italic tracking-wide text-sky-400 hover:text-gray-300 focus:text-gray-300 focus:outline-none border-transparent border-l-[12px] border-b-[12px] border-t-[12px]"
    >
      <slot />
    </Link>
  </li>
</template>

<style scoped>
li {
  list-style: none;
}

li:hover a {
  border-top: 12px solid #2b3c46;
  border-bottom: 12px solid #2b3c46;
  color: #cde7f1;
}

li:hover::after {
  display: block;
  width: 19px;
  height: 62px;
  position: absolute;
  top: 0;
  right: -19px;
  content: "";
  background-color: rgb(107 114 128);
  -webkit-animation: animate-blinking 1s infinite; /* Safari 4+ */
  -moz-animation: animate-blinking 1s infinite; /* Fx 5+ */
  -o-animation: animate-blinking 1s infinite; /* Opera 12+ */
  animation: animate-blinking 1s infinite; /* IE 10+, Fx 29+ */
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
