<script setup>
import { Head, Link } from "@inertiajs/vue3";
import ThemeDropdown from "@/Components/ThemeDropdown.vue";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});
</script>

<template>
  <Head title="Welcome" />

  <div
    class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-gray-100 dark:bg-gray-900"
  >
    <div class="sm:fixed sm:top-0 sm:end-0 p-6 text-end z-10 flex items-center">
      <ThemeDropdown class="px-2" />
      <div v-if="!$page.props.auth.user">
        <Link
          v-if="canLogin"
          :href="route('login')"
          class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
        >
          Log in
        </Link>

        <Link
          v-if="canRegister"
          :href="route('register')"
          class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
        >
          Register
        </Link>
      </div>
    </div>

    <div class="max-w-7xl mx-auto p-6 lg:p-8 border-green-500">
      Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
    </div>
  </div>
</template>
