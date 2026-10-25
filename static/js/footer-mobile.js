/**
 * footer-mobile.js
 * Мобильный футер-виджет (slideUp/slideDown при скролле) + аккордеон в футере на iPhone
 */

// ─── Video card hover ──────────────────────────────────────────────────────

function hoverVideo() {
    $(this).find('.media-card__video').get(0).play();
}

function hideVideo() {
    $(this).find('.media-card__video').get(0).pause();
}

// ─── Footer мобильный виджет ───────────────────────────────────────────────

$(document).ready(function () {
    var footerMob = $('.index-footer--mob');
    var footerWidget = $('.widget_o');

    if (footerMob.length > 0 && is_mobile()) {
        footerMob.slideUp();
        footerMob.removeClass('visible');

        $(window).scroll(function () {
            if ($(window).scrollTop() >= window.innerHeight) {
                footerMob.slideDown();
                footerWidget.addClass('visible');
                footerMob.addClass('visible');
            } else {
                footerMob.slideUp();
                footerWidget.removeClass('visible');
                footerMob.removeClass('visible');
            }
        });
    }

    $('.media-card-video-hover').hover(hoverVideo, hideVideo);
});

// ─── iPhone аккордеон в футере ─────────────────────────────────────────────

var iphone = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase())) && (screen.width < 767);
if (iphone) {
    $('.footer-block__col').each(function () {
        $(this).find('.footer-block__name').click(function () {
            if ($(this).parent().hasClass('active')) {
                $(this).parent().removeClass('active');
                $('.footer-block__col').removeClass('active');
            } else {
                $('.footer-block__col').removeClass('active');
                $(this).parent().addClass('active');
            }
            return false;
        });
    });
}
