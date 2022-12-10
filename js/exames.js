document.addEventListener("DOMContentLoaded", () => {
  if (window.matchMedia("(pointer: coarse)").matches) {
    document.querySelectorAll(".nome").forEach((element) => {
      element.parentElement.classList.add("dropdown");
    });
  }
});
