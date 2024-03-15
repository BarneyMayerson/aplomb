<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { useModal } from "momentum-modal";
import AppLogo from "@/Components/AppLogo.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SlideDialogModal from "@/Components/SlideDialogModal.vue";

defineProps({
  status: String,
});

const form = useForm({
  email: "",
});

const submit = () => {
  form.post(route("password.email"));
};

const { close } = useModal();
</script>

<template>
  <Head title="Forgot Password" />

  <SlideDialogModal @close="close" maxWidth="md" dialogTitle="Forgot Password">
    <template #content>
      <div class="flex justify-center mb-4">
        <Link :href="route('home')">
          <AppLogo class="h-20 w-full" />
        </Link>
      </div>

      <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        Forgot your password? No problem. Just let us know your email address
        and we will email you a password reset link that will allow you to
        choose a new one.
      </div>

      <div
        v-if="status"
        class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"
      >
        {{ status }}
      </div>

      <form @submit.prevent="submit">
        <div>
          <InputLabel for="email" value="Email" />
          <TextInput
            id="email"
            v-model="form.email"
            type="email"
            class="mt-1 block w-full"
            required
            autofocus
            autocomplete="username"
          />
          <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="flex items-center justify-end mt-4">
          <PrimaryButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Email Password Reset Link
          </PrimaryButton>
        </div>
      </form>
    </template>
  </SlideDialogModal>
</template>
