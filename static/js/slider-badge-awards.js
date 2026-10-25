window.addEventListener("DOMContentLoaded", function () {
  const badgeAwardsContainer = document.querySelector(".badge-awards__container");

  if (badgeAwardsContainer && badgeAwardsContainer.scrollWidth > badgeAwardsContainer.offsetWidth) {
    const swiperBadgeAwards = new Swiper('.badge-awards__swiper-container', {
      centeredSlides: true,
      loop: true,
      slideToClickedSlide: false,
      spaceBetween: 10,
      slidesPerView: "auto",
      600: {
        spaceBetween: 30,
      },
    })
  }

  window.addEventListener("resize", () => {
    setTimeout(() => {
      if (badgeAwardsContainer && badgeAwardsContainer.scrollWidth > badgeAwardsContainer.offsetWidth) {
        const swiperBadgeAwards = new Swiper('.badge-awards__swiper-container', {
          centeredSlides: true,
          loop: true,
          slideToClickedSlide: false,
          spaceBetween: 10,
          slidesPerView: "auto",
          600: {
            spaceBetween: 30,
          },
        })
      }
    }, 500)
  })
})