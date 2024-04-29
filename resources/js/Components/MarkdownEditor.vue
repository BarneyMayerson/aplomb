<script setup>
import { watch } from "vue";
import { EditorContent, useEditor } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";
import { Markdown } from "tiptap-markdown";
import { Link } from "@tiptap/extension-link";
import { Underline } from "@tiptap/extension-underline";
import { Highlight } from "@tiptap/extension-highlight";
import "remixicon/fonts/remixicon.css";

const props = defineProps({
  modelValue: "",
});

const emit = defineEmits(["update:modelValue"]);

const editor = useEditor({
  extensions: [
    StarterKit.configure({
      heading: {
        levels: [2, 3, 4],
      },
      code: false,
    }),
    Markdown,
    Link,
    Underline,
    Highlight,
  ],
  content: props.modelValue,
  onUpdate: () =>
    emit("update:modelValue", editor.value?.storage.markdown.getMarkdown()),
  editorProps: {
    attributes: {
      class: `bg-white dark:bg-gray-900 ring-1 ring-inset ring-gray-300 dark:ring-gray-700 prose dark:prose-invert max-w-none rounded-b-md focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:focus:ring-indigo-600 py-1.5 px-3 min-h-[520px]`,
    },
  },
});

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

const promptUserForHref = () => {
  if (editor.value?.isActive("link")) {
    return editor.value?.chain().unsetLink().run();
  }

  const href = prompt("Where do you want to link to?");

  if (!href) {
    return editor.value?.chain().focus().run();
  }

  return editor.value?.chain().focus().setLink({ href }).run();
};
</script>

<template>
  <div
    v-if="editor"
    class="bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white rounded-md shadow-sm border-0 ring-1 ring-inset ring-gray-300 dark:ring-gray-700"
  >
    <menu class="flex divide-x divide-gray-300 dark:divide-gray-700">
      <li>
        <button
          @click="() => editor.chain().focus().toggleBold().run()"
          type="button"
          class="px-3 py-2 rounded-tl-md"
          :class="[
            editor.isActive('bold')
              ? 'bg-indigo-300 dark:bg-indigo-500'
              : 'hover:bg-gray-200 dark:hover:bg-gray-600',
          ]"
          title="Bold"
        >
          <i class="ri-bold"></i>
        </button>
      </li>
      <li>
        <button
          @click="() => editor.chain().focus().toggleItalic().run()"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('italic')
              ? 'bg-indigo-300 dark:bg-indigo-500'
              : 'hover:bg-gray-200 dark:hover:bg-gray-600',
          ]"
          title="Italic"
        >
          <i class="ri-italic"></i>
        </button>
      </li>
      <li>
        <button
          @click="() => editor.chain().focus().toggleUnderline().run()"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('underline')
              ? 'bg-indigo-300 dark:bg-indigo-500'
              : 'hover:bg-gray-200 dark:hover:bg-gray-600',
          ]"
          title="Underline"
        >
          <i class="ri-underline"></i>
        </button>
      </li>
      <li>
        <button
          @click="() => editor.chain().focus().toggleStrike().run()"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('strike')
              ? 'bg-indigo-300 dark:bg-indigo-500'
              : 'hover:bg-gray-200 dark:hover:bg-gray-600',
          ]"
          title="Strikethrough"
        >
          <i class="ri-strikethrough"></i>
        </button>
      </li>
      <li>
        <button
          @click="() => editor.chain().focus().toggleHighlight().run()"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('highlight')
              ? 'bg-indigo-300 dark:bg-indigo-500'
              : 'hover:bg-gray-200 dark:hover:bg-gray-600',
          ]"
          title="Highlight"
        >
          <i class="ri-text bg-[#ffff00] p-1 dark:text-black"></i>
        </button>
      </li>
      <li>
        <button
          @click="() => editor.chain().focus().toggleBlockquote().run()"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('blockquote')
              ? 'bg-indigo-300 dark:bg-indigo-500'
              : 'hover:bg-gray-200 dark:hover:bg-gray-600',
          ]"
          title="Blockquote"
        >
          <i class="ri-double-quotes-l"></i>
        </button>
      </li>
      <li>
        <button
          @click="() => editor.chain().focus().toggleCodeBlock().run()"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('codeBlock')
              ? 'bg-indigo-300 dark:bg-indigo-500'
              : 'hover:bg-gray-200 dark:hover:bg-gray-600',
          ]"
          title="Code Block"
        >
          <i class="ri-code-line"></i>
        </button>
      </li>
      <li>
        <button
          @click="() => editor.chain().focus().toggleBulletList().run()"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('bulletList')
              ? 'bg-indigo-300 dark:bg-indigo-500'
              : 'hover:bg-gray-200 dark:hover:bg-gray-600',
          ]"
          title="Bullet list"
        >
          <i class="ri-list-unordered"></i>
        </button>
      </li>
      <li>
        <button
          @click="() => editor.chain().focus().toggleOrderedList().run()"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('orderedList')
              ? 'bg-indigo-300 dark:bg-indigo-500'
              : 'hover:bg-gray-200 dark:hover:bg-gray-600',
          ]"
          title="Numeric list"
        >
          <i class="ri-list-ordered"></i>
        </button>
      </li>
      <li>
        <button
          @click="promptUserForHref"
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('link')
              ? 'bg-indigo-500'
              : 'hover:bg-gray-200 dark:hover:bg-gray-600',
          ]"
          title="Add link"
        >
          <i class="ri-link"></i>
        </button>
      </li>
      <li>
        <button
          @click="
            () => editor.chain().focus().toggleHeading({ level: 2 }).run()
          "
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('heading', { level: 2 })
              ? 'bg-indigo-500'
              : 'hover:bg-gray-200 dark:hover:bg-gray-600',
          ]"
          title="Heading 1"
        >
          <i class="ri-h-1"></i>
        </button>
      </li>
      <li>
        <button
          @click="
            () => editor.chain().focus().toggleHeading({ level: 3 }).run()
          "
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('heading', { level: 3 })
              ? 'bg-indigo-500'
              : 'hover:bg-gray-200 dark:hover:bg-gray-600',
          ]"
          title="Heading 2"
        >
          <i class="ri-h-2"></i>
        </button>
      </li>
      <li>
        <button
          @click="
            () => editor.chain().focus().toggleHeading({ level: 4 }).run()
          "
          type="button"
          class="px-3 py-2"
          :class="[
            editor.isActive('heading', { level: 4 })
              ? 'bg-indigo-500'
              : 'hover:bg-gray-200 dark:hover:bg-gray-600',
          ]"
          title="Heading 3"
        >
          <i class="ri-h-3"></i>
        </button>
      </li>
    </menu>
    <EditorContent :editor />
  </div>
</template>
