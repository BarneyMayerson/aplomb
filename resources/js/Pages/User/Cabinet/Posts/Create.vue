<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import CabinetNavbar from "@/Navs/CabinetNavbar.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm("PostForm", {
  title: "",
  body: "",
});

const createPost = () => form.post(route("cabinet.posts.store"));
</script>

<template>
  <Head title="Create a Post" id="head" />
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-[180px_auto]">
      <CabinetNavbar class="py-2 md:py-6" />
      <div class="px-4 py-8">
        <div class="flex items-center justify-between">
          <h3 class="text-xl font-semibold">Create a Post</h3>
          <Link :href="route('cabinet.posts.index')">
            <PrimaryButton>Your Posts</PrimaryButton>
          </Link>
        </div>
        <form @submit.prevent="createPost" class="mt-8">
          <div>
            <InputLabel value="Title" for="title" class="sr-only" />
            <TextInput
              id="title"
              v-model="form.title"
              class="w-full"
              placeholder="Give it a great title ..."
              autofocus
            />
            <InputError :message="form.errors.title" class="mt-1" />
          </div>
          <div class="mt-4">
            <InputLabel value="Body" for="body" class="sr-only" />
            <TextArea id="body" v-model="form.body" rows="12" />
            <InputError :message="form.errors.body" class="mt-1" />
          </div>
          <div class="mt-4">
            <PrimaryButton type="submint">Create Post</PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
