(function () {
  function initDoctors() {
    var $gridEl = $(".doctor-list__sort_bl");
    if (!$gridEl.length) return;

    var $grid = $gridEl.isotope({
      itemSelector: ".doctor-list__section",
      layoutMode: "fitRows",
      percentPosition: true,
      resizesContainer: true,
      resizable: true,
    });

    // Если карточки подгружаются с сервера через AJAX — перезагружаем isotope
    var reloadTimer;
    var mutationObserver = new MutationObserver(function () {
      clearTimeout(reloadTimer);
      reloadTimer = setTimeout(function () {
        $grid.isotope("reloadItems").isotope("layout");
      }, 100);
    });
    mutationObserver.observe($gridEl[0], { childList: true });

    $(".filters-select").change(function () {
      var filterValue = this.value;
      $grid.isotope({ filter: filterValue });
    });

    $(".filter__tagline .tag").click(function () {
      var filterValue = $(this).attr("data-filter");
      $(".filter__tagline .tag").removeClass("tag_current");
      $(this).addClass("tag_current");
      $(".heading").removeClass("active");
      $(filterValue).addClass("filter-active");
      $(filterValue).removeClass("doctor-item_primary");
      if (filterValue === "*") {
        $(".doctor__sort-primary").addClass("doctor-item_primary");
      }
      $grid.isotope({ filter: filterValue });
    });
  }

  function initVacancy() {
    var $gridEl = $(".vacancy-list__grid");
    if (!$gridEl.length) return;

    var $grid = $gridEl.isotope({
      itemSelector: ".card_vacancy",
    });

    $(".filters-select").change(function () {
      var filterValue = this.value;
      $grid.isotope({ filter: filterValue });
    });

    $(".filter__tagline .tag").click(function () {
      var filterValue = $(this).attr("data-filter");
      $(".filter__tagline .tag").removeClass("tag_current");
      $(this).addClass("tag_current");
      $(".heading").removeClass("active");
      $(filterValue).addClass("filter-active");
      $grid.isotope({ filter: filterValue });
    });
  }

  function initCase() {
    const $gridEl = $(".filter-list");
    console.log($gridEl)
    if (!$gridEl.length) return;

    const $grid = $gridEl.isotope({
      itemSelector: ".filter-item",
    });

    $(".filter__tagline .tag").click(function () {
      var filterValue = $(this).attr("data-filter");
      $(".filter__tagline .tag").removeClass("tag_current");
      $(this).addClass("tag_current");
      $(".heading").removeClass("active");
      $(filterValue).addClass("filter-active");
      $grid.isotope({ filter: filterValue });
    });
  }

  function init() {
    initDoctors();
    initVacancy();
    initCase();
  }

  if (document.readyState !== "loading") {
    init();
  } else {
    document.addEventListener("DOMContentLoaded", init);
  }
})();
