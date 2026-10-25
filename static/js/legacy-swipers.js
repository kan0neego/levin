/**
 * legacy-swipers.js
 * Инициализации Swiper-слайдеров (перенесено из custom.js)
 */

$(document).ready(function () {
    var isMobile =
        /iphone|ipod|ipad|android|blackberry|mini|windows\sce|palm/i.test(
            navigator.userAgent.toLowerCase(),
        ) && screen.width < 767;

    // Equipment swiper (только мобайл)
    if (isMobile) {
        new Swiper(".equipment-swiper.swiper-container", {
            loop: false,
            centeredSlides: false,
            slidesPerView: 2,
            spaceBetween: 20,
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: {
                nextEl: ".swiper-button-next-n",
                prevEl: ".swiper-button-prev-n",
            },
            breakpoints: { 993: { slidesPerView: "auto" } },
        });
    }

    // Certificates slider
    new Swiper(".slide-certificates.swiper-container", {
        slidesPerView: "auto",
        spaceBetween: 20,
        loop: true,
        centeredSlides: false,
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: {
            prevEl: "#certificates-slider-prev",
            nextEl: "#certificates-slider-next",
        },
        on: {
            init: function () {
                if (this.slides.length <= 1) {
                    $("#certificates-slider-prev").hide();
                    $("#certificates-slider-next").hide();
                } else {
                    $("#certificates-slider-prev").show();
                    $("#certificates-slider-next").show();
                }
            },
        },
        breakpoints: { 993: { slidesPerView: "auto", centeredSlides: true } },
    });

    // Doctor slider с миниатюрами
    if ($(".doctor-slider").length > 0) {
        var doctorThumbs = new Swiper(".doctor-thumbs", {
            spaceBetween: 20,
            slidesPerView: 3,
            freeMode: true,
            watchSlidesVisibility: true,
            grabCursor: false,
            watchSlidesProgress: true,
            breakpoints: {
                991: { spaceBetween: 15 },
                1367: { spaceBetween: 20 },
            },
        });
        new Swiper(".doctor-slider", {
            loop: true,
            speed: 400,
            slidesPerView: 1,
            grabCursor: false,
            spaceBetween: 24,
            keyboard: { enabled: true, onlyInViewport: true },
            watchOverflow: true,
            watchSlidesProgress: true,
            watchSlidesVisibility: true,
            roundLengths: true,
            thumbs: { swiper: doctorThumbs },
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: {
                nextEl: ".doctor-slider .section-button-next",
                prevEl: ".doctor-slider .section-button-prev",
            },
        });
    }

    // Gallery new с миниатюрами
    if ($(".gallery-new").length > 0) {
        var galleryNewThumbs = new Swiper(".gallery-new-thumbs", {
            spaceBetween: 22,
            slidesPerView: 5,
            draggable: false,
            freeMode: true,
            watchSlidesVisibility: true,
            touchRatio: 0,
            grabCursor: false,
            watchSlidesProgress: true,
        });
        new Swiper(".gallery-new", {
            loop: true,
            speed: 500,
            slidesPerView: 1,
            grabCursor: false,
            spaceBetween: 24,
            keyboard: { enabled: true, onlyInViewport: true },
            watchOverflow: true,
            watchSlidesProgress: true,
            watchSlidesVisibility: true,
            roundLengths: true,
            thumbs: { swiper: galleryNewThumbs },
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: {
                nextEl: ".gallery-new .section-button-next",
                prevEl: ".gallery-new .section-button-prev",
            },
        });
    }

    // Slider screen с миниатюрами
    if ($(".slider_screen").length > 0) {
        var galleryTop = new Swiper(".slider_screen", {
            spaceBetween: 0,
            lazy: true,
            loop: true,
            loopedSlides: 4,
            effect: "fade",
            navigation: {
                nextEl: ".swiper-button-next-slider",
                prevEl: ".swiper-button-prev-slider",
            },
        });
        var galleryThumbs = new Swiper(".swiper-container.slider_screen_top", {
            spaceBetween: 22,
            centeredSlides: false,
            slidesPerView: "auto",
            touchRatio: 0.2,
            slideToClickedSlide: true,
            loop: true,
            loopedSlides: 4,
        });
        galleryTop.controller.control = galleryThumbs;
        galleryThumbs.controller.control = galleryTop;
    }

    // Articles swiper
    new Swiper(".swiper-container.swiper-articles", {
        loop: true,
        slidesPerView: 3,
        centeredSlides: false,
        spaceBetween: 27,
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: {
            nextEl: ".swiper-button-next-n",
            prevEl: ".swiper-button-prev-n",
        },
        breakpoints: {
            768: { slidesPerView: "auto", spaceBetween: 16 },
            1750: { slidesPerView: 3 },
        },
    });

    // Doctor swiper
    new Swiper(".swiper-container.swiper-doctor", {
        loop: true,
        slidesPerView: "auto",
        centeredSlides: false,
        spaceBetween: 26,
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: {
            nextEl: ".swiper-button-next-n",
            prevEl: ".swiper-button-prev-n",
        },
        breakpoints: {
            768: { slidesPerView: "auto", spaceBetween: 20 },
            992: { slidesPerView: 3, spaceBetween: 20 },
            1800: { slidesPerView: 4, spaceBetween: 20 },
        },
    });

    // List-block slider
    new Swiper(".swiper-container.list-block__slider", {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: {
            nextEl: ".swiper-button-next-w",
            prevEl: ".swiper-button-prev-w",
        },
    });

    // Quote slider
    new Swiper(".swiper-container.slider-quote", {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-quote-next",
            prevEl: ".swiper-quote-prev",
        },
        breakpoints: { 992: { pagination: {} } },
    });
});
