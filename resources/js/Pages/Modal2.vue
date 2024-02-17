<script setup>
import { useModal } from "momentum-modal";
import SlideDialogModal from "@/Components/SlideDialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const { close } = useModal();
</script>

<template>
  <SlideDialogModal
    max-width="xl"
    dialog-title="Title for the Slide Dialog Modal Window"
  >
    <template #content>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem minima
      deleniti nostrum voluptatem, quas quis doloribus cum suscipit magni
      repellendus accusantium distinctio, doloremque dolor culpa placeat fuga.
      Ullam, soluta consequuntur.
    </template>

    <template #footer>
      <SecondaryButton @click="close">Cancel</SecondaryButton>
      <SecondaryButton @click="close" class="ml-4">Save</SecondaryButton>
    </template>
  </SlideDialogModal>
</template>
