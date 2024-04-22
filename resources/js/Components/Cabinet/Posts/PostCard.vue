<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
import { formatDistance, parseISO } from "date-fns";
import {
  EyeIcon,
  PencilIcon,
  TrashIcon,
  BookOpenIcon,
} from "@heroicons/vue/24/outline";

const props = defineProps({
  post: {
    type: Object,
    required: true,
  },
});

const createdForHumans = computed(() =>
  formatDistance(parseISO(props.post.created_at), new Date()),
);

const publishedForHumans = computed(() =>
  props.post.published_at
    ? "Published " +
      formatDistance(parseISO(props.post.published_at), new Date()) +
      " ago"
    : "Not published",
);

const emit = defineEmits(["delete"]);
</script>

<template>
  <div
    class="flex flex-col justify-between rounded-lg px-6 py-4 bg-white dark:bg-gray-800 shadow dark:shadow-sky-400"
  >
    <div>
      <Link
        :href="route('cabinet.posts.show', post.id)"
        class="hover:underline"
      >
        <p class="font-bold">{{ post.title }}</p>
      </Link>
      <span class="block text-sm">Created {{ createdForHumans }} ago </span>
    </div>
    <div class="flex items-end justify-between">
      <span class="block">
        {{ publishedForHumans }}
      </span>
      <div class="mt-2 flex space-x-2 justify-end">
        <Link
          :href="route('cabinet.posts.show', post.id)"
          class="p-2 rounded-md dark:text-gray-200 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition ease-in-out duration-150"
          title="Preview"
        >
          <EyeIcon class="w-5 h-5" />
        </Link>
        <Link
          as="button"
          :href="route('cabinet.posts.edit', post.id)"
          class="p-2 rounded-md dark:text-gray-200 bg-gray-100 dark:bg-gray-700"
          title="Edit"
          :class="[
            post.readonly
              ? 'cursor-not-allowed bg-black/15 dark:bg-black/35'
              : 'cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600 transition ease-in-out duration-150',
          ]"
          :disabled="post.readonly"
        >
          <PencilIcon class="w-5 h-5" />
        </Link>

        <form @submit.prevent="$emit('delete', post.id)">
          <button
            class="p-2 rounded-md text-red-700 dark:text-red-200 bg-red-100 dark:bg-red-700"
            :class="[
              post.readonly
                ? 'cursor-not-allowed bg-black/15 dark:bg-black/35'
                : 'cursor-pointer hover:bg-red-200 dark:hover:bg-red-600 transition ease-in-out duration-150',
            ]"
            :disabled="post.readonly"
          >
            <TrashIcon class="w-5 h-5" />
          </button>
        </form>

        <Link
          as="button"
          href="#"
          class="p-2 rounded-md text-yellow-700 dark:text-yellow-200 bg-yellow-100 dark:bg-yellow-700"
          title="Publish"
          :class="[
            post.readonly
              ? 'cursor-not-allowed bg-black/15 dark:bg-black/35'
              : 'cursor-pointer hover:bg-yellow-200 dark:hover:bg-yellow-600 transition ease-in-out duration-150',
          ]"
          :disabled="post.readonly"
        >
          <BookOpenIcon class="w-5 h-5" />
        </Link>
      </div>
    </div>
  </div>
</template>
