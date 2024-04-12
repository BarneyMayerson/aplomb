<script setup>
import { Head, Link } from "@inertiajs/vue3";
import CabinetNavbar from "@/Navs/CabinetNavbar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
  post: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <Head title="Post Preview" id="head" />
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-[180px_auto]">
      <CabinetNavbar class="py-2 md:py-6" />
      <div class="px-4 py-8">
        <div class="flex items-center justify-between">
          <h2 class="font-semibold text-2xl">{{ post.title }}</h2>
          <Link :href="route('cabinet.posts.index')">
            <PrimaryButton>All Posts</PrimaryButton>
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>
