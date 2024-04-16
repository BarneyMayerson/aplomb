<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import { computed } from "vue";
import CabinetNavbar from "@/Navs/CabinetNavbar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Pagination from "@/Components/Pagination.vue";
import PostCard from "@/Components/Cabinet/Posts/PostCard.vue";
import { useConfirm } from "@/Composables/useConfirm";

const props = defineProps(["posts"]);

const hasPosts = computed(() => !!props.posts.data.length);
const showPagination = computed(() => props.posts.meta.last_page > 1);

const { confirmation } = useConfirm();

const deletePost = async (postId) => {
  if (!(await confirmation("Are you sure you want to delete this post?"))) {
    return;
  }

  router.delete(
    route("cabinet.posts.destroy", {
      post: postId,
      page: props.posts.meta.current_page,
    }),
    {
      preserveScroll: true,
    },
  );
};
</script>

<template>
  <Head title="Your Posts" id="head" />
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-[180px_auto]">
      <CabinetNavbar class="py-2 md:py-6" />
      <div class="px-4 py-8">
        <div class="flex items-center justify-between">
          <h3 class="text-xl font-semibold">Your posts.</h3>
          <Link :href="route('cabinet.posts.create')">
            <PrimaryButton>Create</PrimaryButton>
          </Link>
        </div>
        <div v-if="hasPosts">
          <!-- Posts -->
          <div
            class="mt-8 grid gap-4 grid-cols-1 lg:grid-cols-2 lg:gap-6 xl:grid-cols-3 xl-gap-8"
          >
            <template v-for="post in posts.data" :key="post.id">
              <PostCard :post="post" @delete="deletePost" />
            </template>
          </div>

          <Pagination v-if="showPagination" class="mt-4" :meta="posts.meta" />
        </div>
        <div v-else class="mt-8">
          You don't have any posts yet. You can start creating a new one right
          now. Then you can publish it whenever you want.
        </div>
      </div>
    </div>
  </div>
</template>
