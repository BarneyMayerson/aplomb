<script setup>
import { watchEffect, ref } from "vue";
import { useModal } from "momentum-modal";
import SlidingDialogModal from "@/Components/SlidingDialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const { show, close } = useModal();

const cancelButtonRef = ref(null);

watchEffect(() => {
  if (show) {
    cancelButtonRef.value?.$el.focus();
  }
});

const handleClose = () => close();
</script>

<template>
  <SlidingDialogModal @close="handleClose">
    <template #title> Sliding Dialog Title Goes Here... </template>

    <template #content>
      <div class="flex flex-col space-y-6">
        <p>Sliding Dialog Content Goes Here...</p>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam ex
          facilis voluptates nam culpa dignissimos unde molestias labore?
          Exercitationem natus accusamus unde distinctio odit esse nam aut iste
          assumenda vitae?
        </p>
      </div>
    </template>

    <template #footer>
      <SecondaryButton ref="cancelButtonRef" @click="handleClose">
        Cancel
      </SecondaryButton>
    </template>
  </SlidingDialogModal>
</template>
