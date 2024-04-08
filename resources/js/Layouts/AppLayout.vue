<script setup>
import { Modal } from "momentum-modal";
import Banner from "@/Components/Banner.vue";
import PrimaryMenu from "@/Navs/PrimaryMenu.vue";
</script>

<template>
  <Banner />
  <!-- <PrimaryMenu v-if="$page.props.auth.user" /> -->
  <PrimaryMenu :has-auth-user="!!$page.props.auth.user" />

  <div class="min-h-screen">
    <main>
      <slot />
    </main>
  </div>
  <Modal />
</template>
