<script setup>
import Header from "@/Layouts/Header.vue";
import Welcome from "@/Components/Welcome.vue";
</script>

<template>
  <Header title="Dashboard" />

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div
        class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg"
      >
        <Welcome />
      </div>
    </div>
  </div>
</template>
