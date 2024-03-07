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

  <nav
    class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700"
  >
    <div
      v-if="!$page.props.auth.user"
      class="py-3 max-w-7xl flex mx-auto items-center justify-end"
    >
      <ThemeDropdown class="inline-flex" />
      <Link
        v-if="canLogin"
        :href="route('login')"
        class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
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
  </nav>
</template>
