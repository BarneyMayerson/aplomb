import { mount } from "@vue/test-utils";
import PageTitle from "@/Components/PageTitle.vue";
import { expect } from "vitest";

describe("PageTitle", () => {
  it("renders a title", () => {
    const wrapper = mount(PageTitle, {
      shallow: true,
      props: { title: "Here we go" },
    });

    expect(wrapper.html()).toContain("Here we go");
  });

  it("has the head component with valid title attribute", () => {
    const wrapper = mount(PageTitle, {
      shallow: true,
      props: { title: "Here we go" },
    });

    const head = wrapper.find("#head");

    expect(head.attributes()).toHaveProperty("title", "Here we go");
  });
});
