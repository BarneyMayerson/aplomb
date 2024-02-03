<script setup>
import Header from "@/Layouts/Header.vue";
import ApiTokenManager from "@/Pages/API/Partials/ApiTokenManager.vue";

defineProps({
  tokens: Array,
  availablePermissions: Array,
  defaultPermissions: Array,
});
</script>

<template>
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
</template>
