let swiperPhotosCards = null

function initPhotosCardsSwiper() {
    if (window.innerWidth < 767 && !swiperPhotosCards) {
        swiperPhotosCards = new Swiper('.photos-cards-swiper', {
            spaceBetween: 8,
            slidesPerView: 1.5,
            loop: false,
            breakpoints: {
                450: {
                    slidesPerView: 1.5,
                    spaceBetween: 8
                },
                320: {
                    slidesPerView: 1.1,
                    spaceBetween: 8
                }
            },
        })
    } else if (window.innerWidth >= 767 && swiperPhotosCards) {
        swiperPhotosCards.destroy(true, true)
        swiperPhotosCards = null
    }
}

// Инициализация при загрузке
initPhotosCardsSwiper()

// Отслеживание изменения размера экрана
let resizeTimer
window.addEventListener('resize', function() {
    clearTimeout(resizeTimer)
    resizeTimer = setTimeout(function() {
        initPhotosCardsSwiper()
    }, 250)
})
