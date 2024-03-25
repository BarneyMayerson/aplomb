<script setup>
import PageTitle from "@/Components/PageTitle.vue";

defineProps({
  user: Object,
});
</script>

<template>
  <PageTitle :title="`Profile:: ${user.game_username}`" />
  <div class="">Here is public profile: {{ user.game_username }}</div>
</template>
