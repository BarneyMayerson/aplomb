<script setup>
import { Head, Link } from "@inertiajs/vue3";
import CabinetNavbar from "@/Navs/CabinetNavbar.vue";
import { PlusIcon } from "@heroicons/vue/24/outline";

const props = defineProps(["dialogues"]);
</script>

<template>
  <Head title="Your Dialogues" id="head" />
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-[180px_auto]">
      <CabinetNavbar class="py-2 md:py-6" />
      <div class="px-4 py-8">
        <div
          class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 2xl:grid-cols-6 gap-3"
        >
          <div
            v-for="dialogue in dialogues"
            class="px-3 py-1 rounded-lg border flex flex-col gap-y-1 hover:bg-gray-200 dark:hover:bg-gray-800"
          >
            <Link :href="route('cabinet.dialogues.show', dialogue.id)">
              <span>{{ dialogue.initiator.game_username }}</span>
              <span class="flex justify-center">
                <PlusIcon class="h-5 w-5" aria-hidden="true" />
              </span>
              <span class="flex justify-end">
                {{ dialogue.interlocutor.game_username }}
              </span>
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
