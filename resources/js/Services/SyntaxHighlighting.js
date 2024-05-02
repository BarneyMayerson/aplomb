import hljs from "highlight.js/lib/common";
import "highlight.js/styles/github-dark.css";

export function highlight(selector) {
  if (!selector) {
    hljs.highlightAll();

    return;
  }

  document.querySelectorAll(selector + " pre code").forEach(highlightElement);
}

export function highlightElement(el) {
  hljs.highlightElement(el);
}
