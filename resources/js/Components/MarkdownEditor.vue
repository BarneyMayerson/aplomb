<script setup>
import { watch } from "vue";
import { EditorContent, useEditor } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";
import { Markdown } from "tiptap-markdown";

const editor = useEditor({
  extensions: [StarterKit, Markdown],
  onUpdate: () =>
    emit("update:modelValue", editor.value?.storage.markdown.getMarkdown()),
  editorProps: {
    attributes: {
      class: `bg-white dark:bg-gray-900 ring-1 ring-inset ring-gray-300 dark:ring-gray-700 prose dark:prose-invert max-w-none rounded-b-md focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:focus:ring-indigo-600 py-1.5 px-3 min-h-[100px]`,
    },
  },
});

const props = defineProps({
  modelValue: "",
});

const emit = defineEmits(["update:modelValue"]);

watch(
  () => props.modelValue,
  (value) => {
    if (value === editor.value?.storage.markdown.getMarkdown()) {
      return;
    }

    editor.value?.commands.setContent(value);
  },
  { immediate: true },
);
</script>

<template>
  <EditorContent :editor />
</template>
