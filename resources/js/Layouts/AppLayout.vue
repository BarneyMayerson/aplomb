<script setup>
import { Modal } from "momentum-modal";
import Banner from "@/Components/Banner.vue";
import PrimaryMenu from "@/Navs/PrimaryMenu.vue";
</script>

<template>
  <Banner />
  <PrimaryMenu v-if="$page.props.auth.user" />

  <div
    class="min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-sky-300"
  >
    <main>
      <slot />
    </main>
  </div>
  <Modal />
</template>
