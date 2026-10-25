const swiperDivisions = new Swiper(`.division-slider`, {
  speed: 400,
  loop: true,
  centeredSlides: true,
  slidesPerView: `auto`,
  pagination: {
    el: `.swiper-pagination`,
  },
  navigation: {
    nextEl: `.division-slider__arrow--next`,
    prevEl: `.division-slider__arrow--prev`,
  },
})

const swiperBiocareList = new Swiper(`.about-biocare-list`, {
  freeMode: true,
  spaceBetween: 12,
  slidesPerView: 1.6,
  breakpoints: {
    1024: {
      loop: false,
      slidesPerView: 3,
      spaceBetween: 20
    }
  }
})
// eslint-disable-next-line no-unused-vars
const swiperBiocareMain = new Swiper(`.about-biocare-main`, {
  speed: 400,
  loop: false,
  centeredSlides: true,
  slidesPerView: `auto`,
  watchSlidesProgress: true,
  pagination: {
    el: `.about-biocare-main-slide__pagination`,
    clickable: true
  },
  navigation: {
    nextEl: `.about-biocare-main-slide__arrow--next`,
    prevEl: `.about-biocare-main-slide__arrow--prev`,
  },
  autoplay: {
    delay: 10e3,
    disableOnInteraction: false,
  },
  thumbs: {
    swiper: swiperBiocareList,
  },
})

// eslint-disable-next-line no-unused-vars
const swiperLicense = new Swiper(`.license-list`, {
  speed: 400,
  spaceBetween: 12,
  slidesPerView: 1.2,
  centeredSlides: false,
  breakpoints: {
    1025: {
      initialSlide: 0,
      loop: true,
      slidesPerView: 4.2,
      spaceBetween: 20
    }
  },
  pagination: {
    el: `.license-list__pagination`,
    clickable: true
  },
  navigation: {
    nextEl: `.license-list__arrow--next`,
    prevEl: `.license-list__arrow--prev`,
  },
})
// eslint-disable-next-line no-unused-vars
const swiperTeamCity = new Swiper(`.team-city`, {
  speed: 400,
  spaceBetween: 12,
  slidesPerView: 1.1,
  // centeredSlides: true,
  loop: false,
  breakpoints: {
    320: {
      centeredSlides: false,
    },
    992: {
      slidesPerView: 2.2,
    },
    1300: {
      slidesPerView: 3.2,
      spaceBetween: 24
    }
  },
  pagination: {
    el: `.team-city__pagination`,
    clickable: true
  },
  navigation: {
    nextEl: `.team-city__arrow--next`,
    prevEl: `.team-city__arrow--prev`,
  },
})

// eslint-disable-next-line no-unused-vars
if (window.innerWidth < 1024) {
  const swiperReviews = new Swiper(`.section-reviews-city__swiper`, {
    slidesPerView: 1.07,
    spaceBetween: 20,
    loop: true,
    pagination: {
      el: `.section-reviews-city__pagination`,
      clickable: true
    },
  })
}

// eslint-disable-next-line no-unused-vars
const mySwiper = new Swiper('.slide-certificates__box', {
  slidesPerView: 'auto',
  spaceBetween: 20,
  loop: true,
  centeredSlides: false,
  pagination: {
      el: '.swiper-pagination',
      clickable: true
  },
  navigation: {
      prevEl: "#certificates-slider-prev",
      nextEl: "#certificates-slider-next"
  },

  on: {
      init: function () {
          if (this.slides.length <= 1) {
              $('#certificates-slider-prev').hide();
              $('#certificates-slider-next').hide();
          } else {
              $('#certificates-slider-prev').show();
              $('#certificates-slider-next').show();
          }
      },
  },
  breakpoints: {
      993: {
          slidesPerView: 'auto',
          centeredSlides: true
      }
  }
})

const accordionContactsItems = document.querySelectorAll(`.contacts-accordion__item`)
if (accordionContactsItems) {
  accordionHandler()
}
function accordionHandler() {
  accordionContactsItems.forEach((element) => {
    element.querySelector(`.contacts-accordion__header`).addEventListener(`click`, (event) => {
      event.target.closest(`.contacts-accordion__header`).classList.toggle(`active`)
      event.target.closest(`.contacts-accordion__item`).querySelector(`.contacts-accordion__content`).classList.toggle(`active`)
    })
  })
}

const accordionPathItems = document.querySelectorAll(`.accordion-path__item`)
accordionPathItems && accordionPathHandler(accordionPathItems)

function accordionPathHandler(items) {
  items.forEach((element) => {
    element.querySelector(`.accordion-path__header`).addEventListener(`click`, () => {
      element.classList.toggle(`active`)
    })
  })
}