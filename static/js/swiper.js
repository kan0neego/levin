(function () {
  const config = {
    "doctor-section-slider": {
      loop: true,
      slidesPerView: 1,
      spaceBetween: 0,
      observer: true,
      observeParents: true,
      pagination: {
        el: ".doctor-section-slider .swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".doctor-section-slider .section-button-next",
        prevEl: ".doctor-section-slider .section-button-prev",
      },
    },
    "license-list": {
      spaceBetween: 16,
      slidesPerView: 1.25,
      centeredSlides: true,
      navigation: {
        nextEl: ".license-list__arrow--next",
        prevEl: ".license-list__arrow--prev",
      },
      pagination: {
        el: ".license-list__pagination",
        clickable: true,
      },
      breakpoints: {
        601: { slidesPerView: 3, spaceBetween: 16, centeredSlides: false },
        1025: { slidesPerView: 4, spaceBetween: 22, centeredSlides: false },
      },
    },
  };

  function getActiveSlidesPerView(swiper) {
    const { params } = swiper;
    if (!params.breakpoints) return params.slidesPerView || 1;
    const w = window.innerWidth;
    let perView = params.slidesPerView || 1;
    Object.keys(params.breakpoints)
      .map(Number)
      .sort((a, b) => a - b)
      .forEach((bp) => {
        if (w >= bp) perView = params.breakpoints[bp].slidesPerView || perView;
      });
    return perView;
  }

  function getNavButtons(swiper) {
    const nav = swiper.params.navigation;
    if (!nav) return [];
    return [nav.prevEl, nav.nextEl]
      .filter(Boolean)
      .flatMap((sel) =>
        typeof sel === "string"
          ? Array.from(document.querySelectorAll(sel))
          : [sel],
      );
  }

  function checkAndToggle(slider) {
    const swiper = slider.swiperInstance;
    if (!swiper) return;

    const slides = slider.querySelectorAll(".swiper-slide");
    const perView = getActiveSlidesPerView(swiper);
    const navButtons = getNavButtons(swiper);
    const isActive = slides.length > perView;

    if (isActive) {
      swiper.enable();
      slider.classList.add("swiper-active");
      navButtons.forEach((btn) => (btn.style.display = ""));
    } else {
      swiper.disable();
      slider.classList.remove("swiper-active");
      navButtons.forEach((btn) => (btn.style.display = "none"));
    }
  }

  function initSlider(slider) {
    const option = slider.getAttribute("data-option");
    if (!option || !config[option]) return;

    if (slider.classList.contains("swiper-initialized")) {
      slider.swiperInstance = slider.swiper;
      checkAndToggle(slider);
      return;
    }

    const swiper = new Swiper(slider, config[option]);
    slider.swiperInstance = swiper;
    checkAndToggle(slider);
  }

  window.addEventListener("resize", () => {
    document.querySelectorAll(".swiper[data-option]").forEach((slider) => {
      if (slider.swiperInstance) checkAndToggle(slider);
    });
  });

  function init() {
    document.querySelectorAll(".swiper[data-option]").forEach(initSlider);
  }

  if (document.readyState !== "loading") {
    init();
  } else {
    document.addEventListener("DOMContentLoaded", init);
  }
})();
