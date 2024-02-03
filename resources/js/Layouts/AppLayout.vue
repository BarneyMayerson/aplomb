<script setup>
import Banner from "@/Components/Banner.vue";
import PrimaryMenu from "@/Navs/PrimaryMenu.vue";
</script>

<template>
  <div>
    <Banner />
    <PrimaryMenu v-if="$page.props.auth.user" />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>
