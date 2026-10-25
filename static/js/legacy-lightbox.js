/**
 * legacy-lightbox.js
 * GLightbox + justifiedGallery + lazyBg (перенесено из custom.js)
 */

// ─── Lazy backgrounds ──────────────────────────────────────────────────────

function lazyBg() {
    $('.lazyload-bg').each(function () {
        var lazy = $(this);
        var src = lazy.attr('data-bg');
        $('<img>').attr('src', src).on('load', function () {
            lazy.css('background-image', 'url("' + src + '")');
        });
    });
}

// ─── justifiedGallery + GLightbox для #mygallery ──────────────────────────

$.getScript('https://cdnjs.cloudflare.com/ajax/libs/justifiedGallery/3.8.1/js/jquery.justifiedGallery.min.js', function () {
    var isMobile = (/iphone|ipod|ipad|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase())) && (screen.width < 767);

    new GLightbox({ selector: '#mygallery .glightbox', loop: true });
    $('#mygallery .glightbox').addClass('jg-entry');

    if ($('#mygallery').length > 0) {
        $('#mygallery').justifiedGallery({
            lastRow: 'justify',
            rowHeight: isMobile ? 120 : 250,
            maxRowsCount: isMobile ? 3 : 2,
            margins: 0
        });
    }
});

// ─── Прочие GLightbox инстансы ─────────────────────────────────────────────

// Поддержка динамической загрузки: если 'load' уже сработал — вызываем сразу
(function () {
    function initLightbox() {
        lazyBg();

        new GLightbox({
            selector: '.glightbox3',
            touchNavigation: true,
            loopAtEnd: true
        });

        new GLightbox({
            selector: '.page-gallery-kontakty',
            touchNavigation: true,
            loopAtEnd: true
        });

        new GLightbox({
            selector: '.license-item .glightbox',
            touchNavigation: true,
            loopAtEnd: true
        });
    }

    if (document.readyState === 'complete') {
        initLightbox();
    } else {
        window.addEventListener('load', initLightbox);
    }
})();
