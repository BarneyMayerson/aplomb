import { mount } from "@vue/test-utils";
import AppLogo from "@/Components/AppLogo.vue";

describe("AppLogo", () => {
  it("has default colors", () => {
    const wrapper = mount(AppLogo);

    expect(wrapper.vm.startLineColor).toBe("#5c7785");
    expect(wrapper.vm.leftCarColor).toBe("#7c919d");
    expect(wrapper.vm.rightCarColor).toBe("#9dadb5");
  });
});
