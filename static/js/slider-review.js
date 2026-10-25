window.addEventListener("DOMContentLoaded", function () {
  const swiperReports = new Swiper('.reports-slider', {
    centeredSlides: false,
    loop: false,
    slideToClickedSlide: false,
    slidesPerView: 1.75,
    spaceBetween: 10,
    watchSlidesProgress: true,
    breakpoints: {
      1600: {
        slidesPerView: 4.5,
        spaceBetween: 20,
      },
      1360: {
        slidesPerView: 3.5,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 2.5,
        spaceBetween: 20,
      },
      600: {
        slidesPerView: 2.5,
        spaceBetween: 20,
      },
    },
  });

  const reportSlider = document.querySelector('.reports-slider');
  const reportSlides = document.querySelectorAll('.report-slide');

  reportSlides.forEach((slide) => {
    if (window.innerWidth <= 1024) {

      const video = slide.querySelector(".report__video video");

      if (slide.classList.contains("swiper-slide-active")) {
        video.muted = true;
        if (!slide.classList.contains("--is-active")) {
          video.play();
        }
      }
    }
  })

  const fadeOut = (el, timeout) => {
    el.style.opacity = 1;
    el.style.transition = `opacity ${timeout}ms`;
    el.style.opacity = 0;

    setTimeout(() => {
      el.style.display = 'none';
    }, timeout);
  };

  const fadeIn = (el, timeout, display) => {
    el.style.opacity = 0;
    el.style.display = display || 'flex';
    el.style.transition = `opacity ${timeout}ms`;
    setTimeout(() => {
      el.style.opacity = 1;
    }, 10);
  };

  if (reportSlides) {
    let stopVideos = (ind) => {
      reportSlides.forEach((elem, index) => {
        let buttonPlay = elem.querySelector('.report__play');
        let video = elem.querySelector('video');
        let trigger = elem.querySelector('.report-slide__trigger');

        var isPlaying = video.currentTime > 0 && !video.paused && !video.ended;

        if (isPlaying) {
          video.pause();
          video.load();
        }

        video.removeAttribute('controls');
        trigger.classList.remove('--fade');
        if (ind != index) {
          fadeIn(buttonPlay, 300)
        }
        elem.classList.remove('--is-active');

        if (window.innerWidth <= 1024) {
          const activeVideo = reportSlider.querySelector(".swiper-slide-active").querySelector("video");

          if (!reportSlider.querySelector(".--is-active")) {
            activeVideo.muted = true;
            activeVideo.play();
          }

          //swiperReports.allowTouchMove = true;
        }
      })
    };

    window.addEventListener('click', function (e) {
      let target = e.target || e.srcElement || e.currentTarget
      if (document.querySelector(".reports-slider")) {
        if (!reportSlider.contains(target)) {
          stopVideos(100);
        }
      }
    });

    reportSlides.forEach((elem, index) => {
      let buttonPlay = elem.querySelector('.report__play');
      let video = elem.querySelector('.report__video video');
      let trigger = elem.querySelector('.report-slide__trigger');
      let close = elem.querySelector('.slider__close ');

      if (!elem.classList.contains('--is-active') && window.innerWidth > 1024) {
        trigger.addEventListener('mouseover', () => {
          video.muted = true;
          video.play();
        });

        trigger.addEventListener('mouseout', () => {
          video.load();
        });
      }

      elem.addEventListener('click', () => {
        if (!elem.classList.contains('--is-active')) {
          if (window.innerWidth > 1024) {
            stopVideos(index);
            trigger.classList.add('--fade')
            fadeOut(buttonPlay, 300);
            video.setAttribute('controls', true);
            video.muted = false;
            elem.classList.add('--is-active');
            setTimeout(() => {
              video.currentTime = 0;
              video.play();
            }, 100)
          } else {
            if (!reportSlider.querySelector(".--is-active")) {
              stopVideos(index);
              trigger.classList.add('--fade')
              fadeOut(buttonPlay, 300);
              video.setAttribute('controls', true);
              video.muted = false;
              elem.classList.add('--is-active');

              if (index === reportSlides.length - 1) {
                reportSlides[index - 1].querySelector("video").pause();
                reportSlides[index - 1].querySelector("video").load();
              }

              setTimeout(() => {
                video.currentTime = 0;
                video.play();
              }, 100);

              //swiperReports.allowTouchMove = false;
            } else {
              stopVideos(100);
            }
          }
        }
      });

      close.addEventListener('click', () => {
        video.load();
        setTimeout(() => {
          stopVideos(100);
        }, 100)
      })
    })

    swiperReports.on('slideChange', function () {
      if (reportSlider.querySelector(".--is-active")) {
        stopVideos(100);
      }

      reportSlides.forEach((slide) => {
        if (!reportSlider.querySelector(".--is-active")) {
          slide.querySelector(".report__video video").load();
        }
      })

      if (window.innerWidth <= 1024) {
        let activeIndex = swiperReports.realIndex;
        const slide = reportSlides[activeIndex];
        const video = slide.querySelector(".report__video video");

        video.muted = true;

        if (!slide.classList.contains("--is-active")) {
          video.play();
        }
      }
    });
  }
})