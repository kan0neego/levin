/**
 * ui-misc.js
 * image-blur обёртка, мобильная высота, widget animation, Bootstrap tooltip
 */

jQuery(function ($) {

    // image-blur обёртка
    $('.image-blur').each(function () {
        $(this).wrapAll('<div class="image-blur-wrap"><div class="wrap-image">');
    });

    // Мобильная высота
    if (is_mobile()) {
        $('.sidebar__item').css('height', $(window).height() - 58);
    }

    // Widget animation
    $('.widget_o').addClass('anim');

    // Bootstrap tooltip
    $('[data-toggle="tooltip"]').tooltip({ boundary: 'window', toggleEnabled: true });
});
