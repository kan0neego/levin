/**
 * sidebar-scroll.js
 * Подсветка активного пункта sidebar-r при скролле
 */

function Scroll_block() {
    if ($('.sidebar-r').length === 0) return;
    var scroll_top = $(document).scrollTop();
    $('.sidebar-r__list-item a').each(function () {
        var hash = $(this).attr('href');
        var target = $(hash);
        if (target.length && target.position().top <= scroll_top) {
            $('.sidebar-r__list-item a').removeClass('active');
            $(this).addClass('active');
        }
    });
}

$(document).on('scroll', Scroll_block);
