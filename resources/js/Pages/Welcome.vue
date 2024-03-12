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

  <section>
    <div class="relative container mx-auto">
      <div class="z-0">
        <video autoplay muted loop class="w-full h-full grayscale">
          <source src="/storage/nfsu-trailer.mp4" type="video/mp4" />
          Your browser does not support HTML5 video.
        </video>
        <div
          class="absolute inset-0 bg-[radial-gradient(circle_at_2%_22%,rgba(2,4,7,0),rgb(2,4,7)_79%)]"
        ></div>
      </div>
      <div class="z-20 absolute bottom-1 left-1">
        <h1
          class="z-20text-balance text-center font-kanit text-[50px] uppercase md:text-[7vw] lg:mb-0 lg:mt-0 lg:text-left xl:text-[8vw] 2xl:text-[9vw]"
          style="line-height: 0.8em"
        >
          <span
            class="inline-block bg-clip-text text-transparent bg-gradient-to-r from-gray-300 via-gray-400 to-gray-500 dark:from-white dark:via-gray-200 dark:to-gray-400"
          >
            Straight for the NFS&nbsp;Underground racers.
          </span>
        </h1>
      </div>
    </div>
  </section>
</template>
