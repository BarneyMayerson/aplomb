<script setup>
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import { formatDistance, parseISO } from "date-fns";
import CabinetNavbar from "@/Navs/CabinetNavbar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import WarningButton from "@/Components/WarningButton.vue";
import { computed } from "vue";
import { useConfirm } from "@/Composables/useConfirm";

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

const author = computed(() => usePage().props.auth.user?.game_username);

const { confirmation } = useConfirm();

const deletePost = async () => {
  if (!(await confirmation("Are you sure you want to delete this post?"))) {
    return;
  }

  router.delete(
    route("cabinet.posts.destroy", {
      post: props.post.id,
      page: 1,
    }),
  );
};

const publishPost = async () => {
  if (
    !(await confirmation(
      "Once a post is published, you will not be able to edit or unpublish. Are you sure you want to delete this post?",
    ))
  ) {
    return;
  }

  router.patch(
    route("cabinet.posts.publish", {
      post: props.post.id,
    }),
  );
};
</script>

<template>
  <Head title="Post Preview" id="head" />
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-[180px_auto]">
      <CabinetNavbar class="py-2 md:py-6" />
      <div class="px-4 py-8">
        <div class="flex justify-between">
          <div>
            <h1 class="font-bold text-3xl">{{ post.title }}</h1>
            <span class="block mt-1 text-sm">
              Created: {{ createdForHumans }} ago by {{ author }}
            </span>
            <span class="block mt-1 text-sm">
              Published: {{ publishedForHumans }}
            </span>
          </div>
          <Link :href="route('cabinet.posts.index')">
            <PrimaryButton>All Posts</PrimaryButton>
          </Link>
        </div>
        <article
          class="mt-6 prose dark:prose-invert prose-lg max-w-none"
          v-html="post.html"
        />
        <div class="mt-8 flex items-center space-x-3">
          <Link
            as="button"
            :href="route('cabinet.posts.edit', post.id)"
            :disabled="post.readonly"
          >
            <PrimaryButton
              :class="{ 'blur-sm cursor-not-allowed': post.readonly }"
            >
              Edit
            </PrimaryButton>
          </Link>
          <form @submit.prevent="publishPost">
            <WarningButton
              type="submit"
              :class="{ 'blur-sm cursor-not-allowed': post.readonly }"
              >Publish</WarningButton
            >
          </form>
          <form @submit.prevent="deletePost">
            <DangerButton
              type="submit"
              :class="{ 'blur-sm cursor-not-allowed': post.readonly }"
              >Delete</DangerButton
            >
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
