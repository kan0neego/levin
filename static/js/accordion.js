(function () {
  function init() {
    const accordionsHeads = document.querySelectorAll(".accordion-head");
    accordionsHeads && accordionsHeads.forEach((accordionHead) => {
      accordionHead.addEventListener("click", () => {
        accordionHead.parentNode.classList.toggle("accordion-item_active");
      });
    });
  }

  if (document.readyState !== 'loading') {
    init();
  } else {
    document.addEventListener('DOMContentLoaded', init);
  }
})();