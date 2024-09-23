<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import PageTitle from "@/Components/PageTitle.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DialogModal from "@/Components/DialogModal.vue";
import NFSUMenuItem from "@/Components/NFSUMenuItem.vue";

const showDialogModal = ref(false);
</script>

<template>
  <PageTitle title="Dashboard" />

  <div class="py-12">
    <div class="container mx-auto sm:px-6 lg:px-8">
      <div class="my-4">
        <div class="flex space-x-3">
          <SecondaryButton @click="showDialogModal = true">
            Dialog Modal
          </SecondaryButton>

          <Link href="/modal">
            <SecondaryButton>Slide Modal</SecondaryButton>
          </Link>
        </div>
      </div>

      <div class="mt-8">
        <nav class="w-96 main-menu">
          <ul>
            <NFSUMenuItem href="#" active>Tourneys</NFSUMenuItem>
            <NFSUMenuItem href="#">Top Performers</NFSUMenuItem>
            <NFSUMenuItem href="#">Ranked Racers</NFSUMenuItem>
            <NFSUMenuItem href="#">Monitoring Servers</NFSUMenuItem>
          </ul>
        </nav>
      </div>
      <!-- <Welcome /> -->
    </div>
  </div>

  <DialogModal
    :show="showDialogModal"
    @close="showDialogModal = false"
    max-width="lg"
  >
    <template #title> Header goes here </template>
    <template #content>
      <div class="overflow-y-auto max-h-96 p-4">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni nobis,
        earum vitae inventore voluptate facere tempora minima consequatur
        aperiam mollitia odio, neque delectus praesentium suscipit nulla magnam
        perferendis ullam corrupti! Lorem ipsum dolor sit amet consectetur,
        adipisicing elit. Eos, autem! Ab ad nesciunt voluptatum pariatur
        quisquam temporibus debitis expedita dignissimos possimus officia? Harum
        accusamus atque soluta dolor a accusantium hic! Lorem ipsum dolor sit
        amet consectetur adipisicing elit. Laudantium perspiciatis recusandae
        porro quae, aut perferendis maiores expedita et iste fugiat dolore
        voluptates fuga ex odio, asperiores a dolor illo ipsa. Lorem ipsum dolor
        sit amet consectetur adipisicing elit. Magni nobis, earum vitae
        inventore voluptate facere tempora minima consequatur aperiam mollitia
        odio, neque delectus praesentium suscipit nulla magnam perferendis ullam
        corrupti! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eos,
        autem! Ab ad nesciunt voluptatum pariatur quisquam temporibus debitis
        expedita dignissimos possimus officia? Harum accusamus atque soluta
        dolor a accusantium hic! Lorem ipsum dolor sit amet consectetur
        adipisicing elit. Laudantium perspiciatis recusandae porro quae, aut
        perferendis maiores expedita et iste fugiat dolore voluptates fuga ex
        odio, asperiores a dolor illo ipsa.
      </div>
    </template>
    <template #footer>
      <div class="text-sky-500">Footer goes here</div>
    </template>
  </DialogModal>
</template>
