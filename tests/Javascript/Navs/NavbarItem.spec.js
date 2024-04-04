import { shallowMount } from "@vue/test-utils";
import NavbarItem from "@/Navs/NavbarItem.vue";

it("has special classes when active", () => {
  const wrapper = shallowMount(NavbarItem, {
    props: {
      href: "/",
      active: true,
    },
  });

  expect(wrapper.classes()).contains("bg-gray-200", "dark:bg-gray-800");
});
