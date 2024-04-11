<script setup>
import {
  UsersIcon,
  ClipboardDocumentListIcon,
  WalletIcon,
  TableCellsIcon,
} from "@heroicons/vue/24/outline";
import NavbarItem from "@/Navs/NavbarItem.vue";
</script>

<template>
  <div>
    <div class="px-4 py-2 text-gray-800 dark:text-gray-400">
      <h3 class="text-xl">Cabinet Menu</h3>
      <p class="text-xs">Everything here is yours</p>
    </div>
    <nav>
      <div class="flex flex-col gap-y-1">
        <NavbarItem
          :href="route('cabinet.index')"
          :active="route().current('cabinet.index')"
        >
          <div class="flex items-center gap-x-2">
            <WalletIcon class="h-5 w-5 shrink-0" aria-hidden="true" />
            Overall Info
          </div>
        </NavbarItem>

        <NavbarItem href="#">
          <div class="flex items-center gap-x-2">
            <TableCellsIcon class="h-5 w-5 shrink-0" aria-hidden="true" />
            Tourneys
          </div>
        </NavbarItem>

        <NavbarItem
          :href="route('cabinet.posts.index')"
          :active="route().current('cabinet.posts.*')"
        >
          <div class="flex items-center gap-x-2">
            <ClipboardDocumentListIcon
              class="h-5 w-5 shrink-0"
              aria-hidden="true"
            />
            Posts
          </div>
        </NavbarItem>

        <NavbarItem
          :href="route('cabinet.dialogues.index')"
          :active="route().current('cabinet.dialogues.*')"
        >
          <div class="flex items-center gap-x-2">
            <UsersIcon class="h-5 w-5 shrink-0" aria-hidden="true" />
            Dialogues
          </div>
        </NavbarItem>
      </div>
    </nav>
  </div>
</template>
