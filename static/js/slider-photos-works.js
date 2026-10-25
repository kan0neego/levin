const swiperPhotosWorks = new Swiper('.photos-works__swiper-container', {
  centeredSlides: true,
  loop: true,
  slideToClickedSlide: false,
  slidesPerView: 1,
  spaceBetween: 0,
  watchSlidesProgress: true,
  allowTouchMove: false,
  autoHeight: true,
  navigation: {
    nextEl: '.section-button-next',
    prevEl: '.section-button-prev',
  },
  pagination: {
    el: ".photos-works__pagination",
    type: "bullets",
    clickable: true,
  },
});

const swiperThumbsPhotosWorks = new Swiper('.photos-works__thumbs-swiper-container', {
  slideToClickedSlide: true,
  slidesPerView: "auto",
  spaceBetween: 0,
  freeMode: {
    enabled: true,
    sticky: true,
  },
});

const swiperImagesPhotosWorks = new Swiper('.photos-works__images-swiper-container', {
  slideToClickedSlide: true,
  slidesPerView: "auto",
  spaceBetween: 0,
  loop: true,
  /*
  thumbs: {
    swiper: swiperThumbsPhotosWorks[1],
  },
  */
  navigation: {
    nextEl: '.photos-works__thumbs-nav-next',
    prevEl: '.photos-works__thumbs-nav-prev',
  },
})

const photosWorks = document.querySelector(".photos-works");
const photosWorksThumbs = photosWorks && photosWorks.querySelectorAll(".photos-works__thumbs-swiper-container");

photosWorksThumbs && photosWorksThumbs.forEach((item, index) => {

  swiperThumbsPhotosWorks[index].on('click', function () {
    const {
      clickedIndex
    } = this;
    swiperThumbsPhotosWorks[index].slideTo(clickedIndex);
    swiperImagesPhotosWorks[index].slideTo(clickedIndex);

    item.querySelectorAll(".photos-works__thumbs-slide").forEach((elem) => {
      elem.classList.remove("photos-works__thumbs-slide-active");
    })

    item.querySelectorAll(".photos-works__thumbs-slide")[clickedIndex].classList.add("photos-works__thumbs-slide-active");
  });

  swiperImagesPhotosWorks[index].on('slideChange', function () {
    const {
      realIndex
    } = this;

    swiperThumbsPhotosWorks[index].slideTo(realIndex);

    item.querySelectorAll(".photos-works__thumbs-slide").forEach((elem) => {
      elem.classList.remove("photos-works__thumbs-slide-active");
    })

    item.querySelectorAll(".photos-works__thumbs-slide")[realIndex].classList.add("photos-works__thumbs-slide-active");
  })
})