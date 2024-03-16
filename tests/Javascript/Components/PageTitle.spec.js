import { shallowMount } from "@vue/test-utils";
import PageTitle from "@/Components/PageTitle.vue";

describe("PageTitle", () => {
  let wrapper = null;

  beforeEach(() => {
    wrapper = shallowMount(PageTitle, {
      props: { title: "Here we go" },
    });
  });

  it("renders a title", () => {
    expect(wrapper.html()).toContain("Here we go");
  });

  it("has the head component with valid title attribute", () => {
    const head = wrapper.find("#head");

    expect(head.attributes()).toHaveProperty("title", "Here we go");
  });
});
