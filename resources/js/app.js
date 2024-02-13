import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { modal } from "momentum-modal";
import AppLayout from "@/Layouts/AppLayout.vue";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

function resolvePageComponent(name, pages) {
  for (const path in pages) {
    if (path.endsWith(`${name.replace(".", "/")}.vue`)) {
      return typeof pages[path] === "function" ? pages[path]() : pages[path];
    }
  }

  throw new Error(`Page not found: ${name}`);
}

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => {
    const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
    let page = pages[`./Pages/${name}.vue`];
    page.default.layout = page.default.layout || AppLayout;
    return page;
  },
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(modal, {
        resolve: (name) =>
          resolvePageComponent(name, import.meta.glob("./Pages/**/*.vue")),
      })
      .use(plugin)
      .use(ZiggyVue)
      .mount(el);
  },
  progress: {
    color: "#b4dee7",
    showSpinner: true,
  },
});
