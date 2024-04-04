<script setup>
import { Head, Link } from "@inertiajs/vue3";
import CabinetNavbar from "@/Navs/CabinetNavbar.vue";

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
          <template v-for="message in dialogue.messages">
            <div class="w-full space-y-2">
              <div
                v-if="message.to === dialogue.partner.game_username"
                class="mb-3 w-5/6 bg-gray-100 dark:bg-gray-950 border border-gray-300 dark:border-gray-800 rounded-lg px-4 py-2"
              >
                {{ message.text }}
                <span
                  class="block text-xs font-semibold text-gray-500 dark:text-gray-400 text-right"
                >
                  {{ message.created_at }}
                </span>
              </div>
              <div
                v-else
                class="mb-3 w-5/6 float-right bg-stone-100 dark:bg-stone-950 border border-stone-300 dark:border-stone-800 rounded-lg px-4 py-2"
              >
                {{ message.text }}
                <span
                  class="block text-xs font-semibold text-gray-500 dark:text-gray-400 text-right"
                >
                  {{ message.created_at }}
                </span>
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>
