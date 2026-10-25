(function () {
  function init() {
    var swiperVideoReviews = new Swiper('.video-reviews__swiper-container', {
      centeredSlides: true,
      loop: true,
      slideToClickedSlide: false,
      slidesPerView: "auto",
      spaceBetween: 0,
      watchSlidesProgress: true,
      navigation: {
        nextEl: '.video-reviews-next',
        prevEl: '.video-reviews-prev',
      },
      pagination: {
        el: ".video-reviews-pagination",
        type: "bullets",
        clickable: true,
      },
    });

    function isMobileDevice() {
      return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }

    var videoReviewsSlide = document.querySelectorAll(".video-reviews__slide");

    videoReviewsSlide.forEach(function (elem) {
      var video = elem.querySelector("video");

      if (!isMobileDevice() && video) {
        elem.addEventListener('mouseover', function () {
          var playPromise = video.play();
          if (playPromise !== undefined) {
            playPromise.then(function () {
              video.muted = true;
              video.play();
            });
          }
        });

        elem.addEventListener('mouseout', function () {
          video.load();
        });
      }
    });
  }

  if (document.readyState !== 'loading') {
    init();
  } else {
    document.addEventListener('DOMContentLoaded', init);
  }
})();
