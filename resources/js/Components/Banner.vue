<script setup>
import { ref, watchEffect } from "vue";
import { usePage } from "@inertiajs/vue3";
import CheckCircleIcon from "@/Components/Icons/CheckCircleIcon.vue";
import ExclamationTriangleIcon from "@/Components/Icons/ExclamationTriangleIcon.vue";
import XMarkIcon from "@/Components/Icons/XMarkIcon.vue";

const page = usePage();
const show = ref(true);
const style = ref("success");
const message = ref("");

watchEffect(async () => {
  style.value = page.props.jetstream.flash?.bannerStyle || "success";
  message.value = page.props.jetstream.flash?.banner || "";
  show.value = true;
});
</script>

<template>
  <div>
    <div
      v-if="show && message"
      :class="{
        'bg-indigo-500': style == 'success',
        'bg-red-700': style == 'danger',
      }"
    >
      <div class="container mx-auto py-2 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap">
          <div class="w-0 flex-1 flex items-center min-w-0">
            <span
              class="flex p-2 rounded-lg"
              :class="{
                'bg-indigo-600': style == 'success',
                'bg-red-600': style == 'danger',
              }"
            >
              <CheckCircleIcon
                v-if="style == 'success'"
                class="h-5 w-5 text-white"
              />
              <ExclamationTriangleIcon
                v-if="style == 'danger'"
                class="h-5 w-5 text-white"
              />
            </span>
            <p class="ms-3 font-medium text-sm text-white truncate">
              {{ message }}
            </p>
          </div>

          <div class="shrink-0 sm:ms-3">
            <button
              type="button"
              class="-me-1 flex p-2 rounded-md focus:outline-none sm:-me-2 transition"
              :class="{
                'hover:bg-indigo-600 focus:bg-indigo-600': style == 'success',
                'hover:bg-red-600 focus:bg-red-600': style == 'danger',
              }"
              aria-label="Dismiss"
              @click.prevent="show = false"
            >
              <XMarkIcon class="h-5 w-5 text-white" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
