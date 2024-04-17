<script setup>
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import { formatDistance, parseISO } from "date-fns";
import CabinetNavbar from "@/Navs/CabinetNavbar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { computed } from "vue";
import { useConfirm } from "@/Composables/useConfirm";

const props = defineProps({
  post: {
    type: Object,
    required: true,
  },
});

const formattedDate = computed(() =>
  formatDistance(parseISO(props.post.created_at), new Date()),
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
</script>

<template>
  <Head title="Post Preview" id="head" />
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-[180px_auto]">
      <CabinetNavbar class="py-2 md:py-6" />
      <div class="px-4 py-8">
        <div class="flex justify-between">
          <div>
            <h1 class="font-bold text-2xl">{{ post.title }}</h1>
            <span class="block mt-1 text-sm">
              {{ formattedDate }} ago by {{ author }}
            </span>
          </div>
          <Link :href="route('cabinet.posts.index')">
            <PrimaryButton>All Posts</PrimaryButton>
          </Link>
        </div>
        <article class="mt-6 text-lg xl:text-xl">
          <pre class="whitespace-pre-wrap font-sans">{{ post.body }}</pre>
        </article>
        <div class="mt-8 flex items-center space-x-3">
          <Link :href="route('cabinet.posts.edit', post.id)">
            <PrimaryButton>Edit</PrimaryButton>
          </Link>
          <form @submit.prevent="deletePost">
            <DangerButton type="submit">Delete</DangerButton>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
