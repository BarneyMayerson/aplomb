<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
  meta: {
    type: Object,
    required: true,
  },
  only: {
    type: Array,
    default: () => [],
  },
});

const previousUrl = computed(() => props.meta.links[0].url);
const nextUrl = computed(() => [...props.meta.links].reverse()[0].url);
</script>

<template>
  <div class="flex items-center justify-between py-3">
    <div class="flex flex-1 justify-between md:hidden">
      <Link
        :href="previousUrl"
        :only="only"
        class="relative inline-flex items-center rounded-md border border-gray-300 dark:border-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800"
      >
        Previous
      </Link>
      <Link
        :href="nextUrl"
        :only="only"
        class="relative inline-flex items-center rounded-md border border-gray-300 dark:border-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800"
      >
        Next
      </Link>
    </div>
    <div class="hidden md:flex md:flex-1 md:items-center md:justify-between">
      <div>
        <p class="text-sm text-gray-700 dark:text-gray-400">
          Showing
          {{ " " }}
          <span class="font-medium">{{ meta.from }}</span>
          {{ " " }}
          to
          {{ " " }}
          <span class="font-medium">{{ meta.to }}</span>
          {{ " " }}
          of
          {{ " " }}
          <span class="font-medium">{{ meta.total }}</span>
          {{ " " }}
          results
        </p>
      </div>
      <div>
        <nav
          class="isolate inline-flex -space-x-px rounded-md shadow-sm"
          aria-label="Pagination"
        >
          <Link
            v-for="link in meta.links"
            :href="link.url"
            :only="only"
            class="relative inline-flex items-center first-of-type:rounded-l-md last-of-type:rounded-r-md px-3 py-2"
            :class="{
              '-z-10 bg-sky-600 dark:bg-sky-800 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 dark:focus-visible:outline-sky-800':
                link.active,
              'text-gray-900 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-offset-0':
                !link.active,
            }"
            v-html="link.label"
          >
          </Link>
        </nav>
      </div>
    </div>
  </div>
</template>
