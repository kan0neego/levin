/**
 * loader.js
 * Ленивая загрузка скриптов через IntersectionObserver.
 * Скрипт грузится только если его trigger-элемент есть на странице.
 *
 * eager: true  — грузим сразу при наличии элемента (для скриптов внутри модалок
 *                или тех, что сами управляют ленивой инициализацией)
 * eager: false — грузим когда элемент приближается к viewport
 *
 * Base URL передаётся из PHP через wp_localize_script → window.levin_loader.base
 */

(function () {
    var base = (window.levin_loader && window.levin_loader.base) || '';
    var loaded = {};

    function loadScript(filename) {
        if (loaded[filename]) return;
        loaded[filename] = true;
        var s = document.createElement('script');
        s.src = base + filename;
        document.body.appendChild(s);
    }

    var lazyMap = [
        {
            // Карты могут быть внутри скрытого modal (display:none) — IO там не сработает.
            // Сам скрипт уже ленив: страничные карты ждут 'load', модальные — 'show.bs.modal'.
            selector: '#contactsMap, #contactsMapBranch, #contactsMapUnv, #contactsMapFoot, #mapConct, #mapConctUnv, #myModal',
            script: 'yandex-maps.js',
            eager: true
        },
        {
            selector: '#mygallery, .glightbox3, .page-gallery-kontakty, .glightbox, .lazyload-bg',
            script: 'legacy-lightbox.js',
            eager: false
        },
        {
            selector: 'video.lazy',
            script: 'lazy-video.js',
            eager: false
        },
        {
            selector: '.js-ajax-load',
            script: 'related-posts-ajax.js',
            eager: false
        },
        {
            selector: '.sidebar-r',
            script: 'sidebar-scroll.js',
            eager: false
        },
        {
            selector: '.reports-slider',
            script: 'slider-review.js',
            eager: false
        },
        {
            selector: '.video-reviews__swiper-container',
            script: 'slider-video-reviews.js',
            eager: false
        },
        {
            selector: '.badge-awards__container',
            script: 'slider-badge-awards.js',
            eager: false
        },
        {
            selector: '.contacts-accordion__item, .accordion-path__item',
            script: 'contacts-swiper.js',
            eager: false
        },
        {
            selector: '.photos-cards-swiper',
            script: 'photos-cards-swiper.js',
            eager: false
        },
        {
            selector: '.js-swiper',
            script: 'swiper.js',
            eager: false
        },
        {
            selector: '.wp-block-table.is-style-cards',
            script: 'table-cards.js',
            eager: true
        },
        {
            selector: '.doctors-team-miniatures-swiper',
            script: 'doctors-team-swiper.js',
            eager: false
        },
        {
            selector: '[data-visiblecards]',
            script: 'show-more-cards.js',
            eager: false
        },
        {
            selector: 'progress[data-progress-id]',
            script: 'video-progress.js',
            eager: false
        },
        // Навигация — eager: true, DOM уже готов когда loader запускается
        {
            selector: '.navn__item',
            script: 'nav-menu.js',
            eager: true
        },
        {
            selector: '.mobile-menu',
            script: 'mobile-menu.js',
            eager: true
        },
        {
            selector: '.mobile-header__trigger',
            script: 'mobile-header.js',
            eager: true
        },
        {
            selector: 'header',
            script: 'accordion.js',
            eager: true
        },
        {
            selector: '.question',
            script: 'accordion-faq.js',
            eager: true
        },
        // Всегда на странице — грузим через body как non-blocking
        {
            selector: 'body',
            script: 'cons-widget.js',
            eager: false
        },
        {
            selector: 'body',
            script: 'phone-widget.js',
            eager: false
        },
        {
            selector: 'body',
            script: 'installment-widget.js',
            eager: false
        },
        {
            selector: 'body',
            script: 'metrika-onclick.js',
            eager: false
        },
        {
            selector: 'body',
            script: 'metrika-goals.js',
            eager: false
        },
        {
            selector: 'body',
            script: 'videotube.js',
            eager: false
        },
        {
            selector: 'body',
            script: 'promo-banner.js',
            eager: false
        },
        {
            selector: 'body',
            script: 'forms-handler.js',
            eager: false
        },
    ];

    var supportsIO = 'IntersectionObserver' in window;

    lazyMap.forEach(function (item) {
        var el = null;
        var selectors = item.selector.split(',');
        for (var i = 0; i < selectors.length; i++) {
            el = document.querySelector(selectors[i].trim());
            if (el) break;
        }
        if (!el) return; // элемента нет на странице — скрипт не нужен

        if (item.eager || !supportsIO) {
            loadScript(item.script);
            return;
        }

        var observer = new IntersectionObserver(function (entries, obs) {
            if (entries[0].isIntersecting) {
                loadScript(item.script);
                obs.disconnect();
            }
        }, { rootMargin: '0px', threshold: 0.01 });
        observer.observe(el);
    });
})();
