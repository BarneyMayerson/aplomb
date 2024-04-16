<script setup>
import { useConfirm } from "@/Composables/useConfirm";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const { state, confirm, cancel } = useConfirm();
</script>

<template>
  <ConfirmationModal :show="state.show">
    <template #title>{{ state.title }}</template>

    <template #content>{{ state.message }}</template>

    <template #footer>
      <SecondaryButton @click="cancel">Cancel</SecondaryButton>
      <PrimaryButton @click="confirm" class="ml-3">Confirm</PrimaryButton>
    </template>
  </ConfirmationModal>
</template>
