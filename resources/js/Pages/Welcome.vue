<script setup>
import { Head } from "@inertiajs/vue3";
import LikeGameMenuItem from "@/Components/NFSUBrandTrivia/LikeGameMenuItem.vue";
import SpinCircle from "@/Components/NFSUBrandTrivia/SpinCircle.vue";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});
</script>

<template>
  <Head title="Welcome" />

  <section class="py-8 container mx-auto">
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
      <div
        class="z-20 absolute inset-0 flex flex-col items-center gap-y-28 lg:flex-row lg:gap-x-8 px-2"
      >
        <h1
          class="z-20 text-balance text-center font-kanit text-[50px] uppercase py-24 md:text-[6vw] lg:text-left xl:text-[7vw] 2xl:text-[8vw]"
          style="line-height: 0.8em"
        >
          <span
            class="inline-block bg-clip-text text-transparent bg-gradient-to-r from-gray-300 via-gray-400 to-gray-500 dark:from-white dark:via-gray-200 dark:to-gray-400"
          >
            Straight for the NFS Underground racers.
          </span>
        </h1>

        <div
          class="z-10 h-auto flex-shrink-0 w-80 overflow-visible rounded-xl border border-grey-600/10 bg-gray-900 p-6"
        >
          <div class="flex flex-col gap-y-3">
            <div class="flex items-center justify-end">
              <SpinCircle :pulseDuration="3" :rotateDuration="3" />
              <SpinCircle :pulseDuration="1.3" opacityValues="0.2;1;0.2" />
              <SpinCircle
                :pulseDuration="1.8"
                :rotateDuration="2.7"
                opacityValues="0.5;0.9;0.5"
              />
              <SpinCircle :rotateDuration="2.8" opacityValues="0.3;1;0.3" />
            </div>
            <div class="my-3 flex justify-end">
              <h3
                class="font-san font-semibold text-4xl uppercase italic tracking-wider text-sky-300"
              >
                Main Menu
              </h3>
            </div>
            <LikeGameMenuItem href="#">Competitions</LikeGameMenuItem>
            <LikeGameMenuItem href="#">Tourneys</LikeGameMenuItem>
            <LikeGameMenuItem href="#">Standings</LikeGameMenuItem>
            <LikeGameMenuItem href="#">Game Server</LikeGameMenuItem>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
