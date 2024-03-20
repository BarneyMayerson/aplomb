import { shallowMount } from "@vue/test-utils";
import SpinCircle from "@/Components/NFSUBrandTrivia/SpinCircle.vue";
import { expect } from "vitest";

describe("SpinCircle", () => {
  let wrapper = null;

  beforeEach(() => {
    wrapper = shallowMount(SpinCircle);
  });

  it("has a pulseDuration prop with a default value [2]", () => {
    expect(wrapper.props()).toHaveProperty("pulseDuration", 2);
  });

  it("has a rotateDuration prop with a default value [2]", () => {
    expect(wrapper.props()).toHaveProperty("rotateDuration", 2);
  });

  it("has an opacityValues prop with a default value [0;1;0]", () => {
    expect(wrapper.props()).toHaveProperty("opacityValues", "0;1;0");
  });
});
