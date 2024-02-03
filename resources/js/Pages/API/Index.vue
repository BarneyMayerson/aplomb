<script setup>
import { Head } from "@inertiajs/vue3";
import Header from "@/Layouts/Header.vue";
import ApiTokenManager from "@/Pages/API/Partials/ApiTokenManager.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
  tokens: Array,
  availablePermissions: Array,
  defaultPermissions: Array,
});
</script>

<template>
  <Head title="API Tokens" />
  <AppLayout>
    <Header title="API Tokens" />

    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <ApiTokenManager
          :tokens="tokens"
          :available-permissions="availablePermissions"
          :default-permissions="defaultPermissions"
        />
      </div>
    </div>
  </AppLayout>
</template>
