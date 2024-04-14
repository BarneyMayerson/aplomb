<script setup>
import PageTitle from "@/Components/PageTitle.vue";
import ApiTokenManager from "@/Pages/API/Partials/ApiTokenManager.vue";

defineProps({
  tokens: Array,
  availablePermissions: Array,
  defaultPermissions: Array,
});
</script>

<template>
  <PageTitle title="API Tokens" />

  <div>
    <div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
      <ApiTokenManager
        :tokens="tokens"
        :available-permissions="availablePermissions"
        :default-permissions="defaultPermissions"
      />
    </div>
  </div>
</template>
