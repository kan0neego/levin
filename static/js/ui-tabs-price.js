/**
 * ui-tabs-price.js
 * Anchor scroll, tab system, price accordion, accordeon load class
 */

$(document).ready(function () {

    // Banner anchor scroll
    $('.banner__item').on('click', 'a', function (event) {
        event.preventDefault();
        var top = $($(this).attr('href')).offset().top;
        $('body,html').animate({ scrollTop: top }, 0);
    });

    // Sidebar-r anchor scroll
    $('.sidebar-r__list-item').on('click', 'a', function (event) {
        event.preventDefault();
        var top = $($(this).attr('href')).offset().top;
        $('body,html').animate({ scrollTop: top }, 0);
    });

    // Mobile banner height
    if (is_mobile()) {
        if ($('.banner__content').outerHeight() >= $('.banner').outerHeight()) {
            $('.banner').height('auto').addClass('banner-no-full');
        }
    }

    // Tab system
    // При загрузке страницы всегда открываем первую вкладку в каждом блоке табов —
    // независимо от того, какая была активна в момент сохранения в редакторе
    $('.containers').each(function () {
        $(this).find('.tab-n').removeClass('active');
        $(this).find('.tab-n').first().addClass('active');
    });

    if (is_mobile()) {
        $('.tab-n:not(.open)').removeClass('active');
        $('.tab-n').click(function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                $('.tab-n').removeClass('active');
                $(this).addClass('active');
            }
            $('body,html').animate({ scrollTop: $(this).position().top }, 100);
            return false;
        });
    } else {
        $('.tab-n').click(function () {
            $(this).parent().find('.tab-n').removeClass('active');
            $(this).addClass('active');
            return false;
        });
    }

    // Full height
    $('#fullheight').css({ height: window.innerHeight });

    // Price accordion
    $('.price').each(function () {
        var priceWrap = $(this).find('.price-wrap').height();
        $(this).find('.price-wrap').css({ maxHeight: $(this).hasClass('price-open') ? priceWrap + 'px' : '0' });
        $(this).find('.price-header').click(function () {
            var wrap = $(this).parent().find('.price-wrap');
            wrap.css({ maxHeight: $(this).parent().hasClass('price-open') ? '0' : priceWrap + 'px' });
            $(this).parent().toggleClass('price-open');
        });
    });

    // Accordeon load class
    $('.accordeon').addClass('load');
});
