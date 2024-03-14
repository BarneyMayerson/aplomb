import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
  plugins: [
    laravel({
      input: "resources/js/app.js",
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
  ],

  test: {
    globals: true,
    environment: "jsdom",
    include: ["tests/Javascript/**/*.{test,spec}.?(c|m)[jt]s?(x)"],
    // exclude: [
    //   ...configDefaults.exclude,
    //   "**/.vscode/**",
    //   "**/{app,bootstrap,config,database,public,resources,routes,storage}/**",
    //   "**/tests/{Feature,Unit}/**",
    // ],
  },
});
