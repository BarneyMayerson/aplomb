<script setup>
import CabinetNavbar from "@/Navs/CabinetNavbar.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
  <Head title="Cabinet" id="head" />
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-[180px_auto]">
      <CabinetNavbar class="py-2 md:py-6" />
      <div class="px-4 py-8">Content</div>
    </div>
  </div>
</template>
