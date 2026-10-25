(function () {
  function init() {
    var doctorsTeamMiniaturesSwiper = new Swiper(".doctors-team-miniatures-swiper", {
      spaceBetween: 12,
      slidesPerView: 2,
      loop: false,
      watchSlidesProgress: true,
      freeMode: true,
      breakpoints: {
        767: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
      },
    });

    new Swiper(".doctors-team-swiper", {
      spaceBetween: 16,
      slidesPerView: 1,
      loop: false,
      thumbs: {
        swiper: doctorsTeamMiniaturesSwiper,
      },
      breakpoints: {
        767: {
          spaceBetween: 64,
        },
      },
    });
  }

  if (document.readyState !== 'loading') {
    init();
  } else {
    document.addEventListener('DOMContentLoaded', init);
  }
})();
