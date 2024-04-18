<script setup>
import { EditorContent, useEditor } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";

const editor = useEditor({
  extensions: [StarterKit],
  editorProps: {
    attributes: {
      class: `bg-white dark:bg-gray-900 ring-1 ring-inset ring-gray-300 dark:ring-gray-700 prose dark:prose-invert max-w-none rounded-b-md focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:focus:ring-indigo-600 py-1.5 px-3 min-h-[512px]`,
    },
  },
});
</script>

<template>
  <EditorContent :editor />
</template>
