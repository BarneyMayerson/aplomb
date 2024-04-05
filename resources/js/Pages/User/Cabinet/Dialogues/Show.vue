<script setup>
import { Head, Link } from "@inertiajs/vue3";
import CabinetNavbar from "@/Navs/CabinetNavbar.vue";
import AddMessageForm from "@/Forms/Dialogue/AddMessageForm.vue";
import Message from "@/Components/Dialogue/Message.vue";

const props = defineProps(["dialogue"]);
</script>

<template>
  <Head title="Dialogue" id="head" />
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-[180px_auto]">
      <CabinetNavbar class="py-2 md:py-6" />
      <div class="px-4 py-8">
        <h3 class="text-xl">
          Your private dialogue with
          <Link
            :href="route('public-profile', dialogue.partner.game_username)"
            class="font-bold hover:underline"
          >
            {{ dialogue.partner.game_username }}
          </Link>
          .
        </h3>
        <div
          class="flex flex-col-reverse h-96 border border-gray-300 dark:border-gray-700 rounded-lg px-4 overflow-y-auto mt-4"
        >
          <template v-for="message in dialogue.messages" :key="message.id">
            <div class="w-full space-y-2">
              <Message
                :align-right="message.to === dialogue.partner.game_username"
                :message
              />
            </div>
          </template>
        </div>
        <AddMessageForm :dialogue class="mt-6" />
      </div>
    </div>
  </div>
</template>
