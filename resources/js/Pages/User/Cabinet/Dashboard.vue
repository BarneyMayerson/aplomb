<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
  <Head title="Cabinet" id="head" />
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div
      class="divide-y divide-x-0 md:grid md:grid-cols-7 md:divide-x md:divide-y-0 divide-gray-300 dark:divide-gray-600"
    >
      <div>
        <div class="py-2 md:py-6">
          <div class="px-4 py-2 text-gray-800 dark:text-gray-400">
            <h3 class="text-xl">Cabinet Menu</h3>
            <p class="text-xs">Everything here is yours</p>
          </div>
          <nav>
            <div class="flex flex-col gap-1">
              <div
                class="w-full text-gray-700 hover:text-gray-900 dark:text-gray-500 dark:hover:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800 px-4 py-2 rounded"
              >
                <Link :href="route('cabinet.index')">Overall Info</Link>
              </div>

              <div
                class="w-full text-gray-700 hover:text-gray-900 dark:text-gray-500 dark:hover:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800 px-4 py-2 rounded"
              >
                <Link href="#" class="">Tourneys</Link>
              </div>

              <div
                class="w-full text-gray-700 hover:text-gray-900 dark:text-gray-500 dark:hover:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800 px-4 py-2 rounded"
              >
                <Link href="#" class="">Posts</Link>
              </div>

              <div
                class="w-full text-gray-700 hover:text-gray-900 dark:text-gray-500 dark:hover:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800 px-4 py-2 rounded"
              >
                <Link :href="route('cabinet.dialogues.index')">Dialogues</Link>
              </div>
            </div>
          </nav>
        </div>
      </div>
      <div class="col-span-6">
        <div class="h-80">Content</div>
      </div>
    </div>
  </div>
</template>
