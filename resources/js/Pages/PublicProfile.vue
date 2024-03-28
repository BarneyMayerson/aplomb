<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { useModal } from "momentum-modal";
import PageTitle from "@/Components/PageTitle.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SlideModal from "@/Components/SlideModal.vue";

const props = defineProps({
  user: Object,
});

const page = usePage();

const form = useForm("MessageForm", {
  from: page.props.auth.user?.id,
  to: props.user.id,
  message: "",
});

const { show, close } = useModal();

const showMessageForm = () => {
  show.value = true;
};

const submit = () => {
  form.post(route("cabinet.dialogue.store"), {
    preserveScroll: true,
    onSuccess: form.reset,
  });
};

const enableDialogue = () =>
  page.props.auth.user && page.props.auth.user.id !== props.user.id;
</script>

<template>
  <PageTitle :title="`Profile:: ${user.game_username}`" />
  <div class="">Here is public profile: {{ user.game_username }}</div>

  <div v-if="enableDialogue()" class="mt-8">
    <p class="my-4">
      You can start a private dialogue with
      <strong>{{ user.game_username }}</strong>
    </p>
    <SecondaryButton @click="showMessageForm">
      Send a private message
    </SecondaryButton>

    <SlideModal max-width="lg" @close="close">
      <template #title>
        <h3>
          Starting a dialogue with
          <span class="block text-4xl">{{ user.game_username }}</span>
        </h3>
        <div class="mt-8 text-left">
          <p class="text-base">
            Here you can fill out the form and send a message.
          </p>
          <form @submit.prevent="submit" class="mt-6">
            <InputLabel for="message" value="Message" />
            <TextInput
              id="message"
              v-model="form.message"
              type="text"
              class="mt-1 block w-full"
              required
            />
            <InputError :message="form.errors.message" class="mt-2" />
            <InputError :message="form.errors.from" class="mt-2" />
            <InputError :message="form.errors.to" class="mt-2" />

            <div class="mt-6 flex justify-end">
              <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Send
              </PrimaryButton>
            </div>
          </form>
        </div>
      </template>
    </SlideModal>
  </div>
</template>
