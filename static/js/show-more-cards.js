(function () {
  function init() {
    var containers = document.querySelectorAll("[data-visiblecards]");

    containers.forEach(function (container) {
      var visibleCards = parseInt(container.dataset.visiblecards, 10);
      var cards = container.querySelectorAll(".visible-item");
      var showMoreButton = container.querySelector(".show-more");

      if (cards.length <= visibleCards) {
        showMoreButton.style.display = "none";
        return;
      }

      cards.forEach(function (card, index) {
        if (index >= visibleCards) {
          card.classList.add("ds-none");
        }
      });

      showMoreButton.addEventListener("click", function () {
        cards.forEach(function (card) { card.classList.remove("ds-none"); });
        showMoreButton.style.display = "none";
      });
    });
  }

  if (document.readyState !== 'loading') {
    init();
  } else {
    document.addEventListener('DOMContentLoaded', init);
  }
})();
