<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import PageTitle from "@/Components/PageTitle.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
  user: Object,
});

const page = usePage();

const form = useForm("MessageForm", {
  from: page.props.auth.user.id,
  to: props.user.id,
  message: "",
});

const submit = () => {
  form.post(route("cabinet.dialogue.store"), {
    preserveScroll: true,
    onSuccess: form.reset,
  });
};
</script>

<template>
  <PageTitle :title="`Profile:: ${user.game_username}`" />
  <div class="">Here is public profile: {{ user.game_username }}</div>

  <div v-if="$page.props.auth.user" class="mt-8">
    <p class="">
      You can start a private dialogue with {{ user.game_username }}
    </p>
    <form @submit.prevent="submit">
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

      <PrimaryButton
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Save
      </PrimaryButton>
    </form>
  </div>
</template>
