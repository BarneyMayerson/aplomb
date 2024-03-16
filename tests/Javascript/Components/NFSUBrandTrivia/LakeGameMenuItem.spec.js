import { shallowMount } from "@vue/test-utils";
import LikeGameMenuItem from "@/Components/NFSUBrandTrivia/LikeGameMenuItem.vue";

describe("LikeGameMenuItem", () => {
  it("has href property", () => {
    const wrapper = shallowMount(LikeGameMenuItem, {
      props: {
        href: "/test",
      },
    });

    expect(wrapper.props()).toHaveProperty("href", "/test");
  });
});
