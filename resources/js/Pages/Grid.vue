<script setup>
import PageTitle from "@/Components/PageTitle.vue";
</script>

<template>
  <PageTitle title="Grid" />

  <div
    class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-900 dark:text-gray-400"
  >
    <div class="mt-4">
      <h1 class="text-2xl font-semibold">Here is grid</h1>

      <div class="mt-4 grid gap-2 grid-cols-10 grid-rows-2">
        <div class="p-4 border">Company</div>
        <div class="p-4 border">Date</div>
        <div class="p-4 border">Single-section</div>
        <div class="p-4 border">Count</div>
        <div class="p-4 border">Hours</div>
        <div class="p-4 border">Type of work</div>
        <div class="p-4 border">Depot</div>
        <div class="p-4 border">Matchings</div>
        <div
          class="p-4 border row-span-2 flex flex-col justify-center items-center"
        >
          <div>Approved</div>
          <div>1</div>
          <div>2</div>
          <div>3</div>
        </div>
        <div class="p-4 border row-span-2">Actions</div>
        <div class="p-4 border col-span-8">Description</div>
      </div>
    </div>
  </div>
</template>
