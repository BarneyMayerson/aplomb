<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { computed } from "vue";
import CabinetNavbar from "@/Navs/CabinetNavbar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps(["posts"]);

const hasPosts = computed(() => !!props.posts.data.length);
const showPagination = computed(() => props.posts.meta.last_page > 1);
</script>

<template>
  <Head title="Your Posts" id="head" />
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-[180px_auto]">
      <CabinetNavbar class="py-2 md:py-6" />
      <div class="px-4 py-8">
        <div v-if="hasPosts">
          <div class="flex items-center justify-between">
            <h3 class="text-xl font-semibold">Your posts.</h3>
            <Link href="#">
              <PrimaryButton>Create</PrimaryButton>
            </Link>
          </div>

          <!-- Posts -->
          <div
            class="mt-8 grid gap-4 grid-cols-1 lg:grid-cols-2 lg:gap-6 xl:grid-cols-3 xl-gap-8"
          >
            <div
              v-for="post in posts.data"
              :key="post.id"
              class="rounded-lg px-6 py-3 flex flex-col justify-between bg-white dark:bg-gray-800 shadow dark:shadow-sky-400"
            >
              <div>
                <p class="font-bold">{{ post.title }}</p>
              </div>
              <div class="flex justify-end space-x-2 w-full">
                <PrimaryButton v-if="!post.published_at">
                  Publish
                </PrimaryButton>
                <DangerButton v-if="!post.published_at">Delete</DangerButton>
                <PrimaryButton>Preview</PrimaryButton>
                <PrimaryButton>Edit</PrimaryButton>
              </div>
            </div>
          </div>

          <Pagination v-if="showPagination" class="mt-4" :meta="posts.meta" />
        </div>
        <div v-else>
          You don't have any posts yet. You can start creating a new one right
          now. Then you can publish it whenever you want.
        </div>
      </div>
    </div>
  </div>
</template>
