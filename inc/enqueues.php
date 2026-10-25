<?php

function defer_jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_template_directory_uri() . '/src/vendor/jquery.min.js', [], null, true);
        wp_enqueue_script('jquery');
    }
}

add_action('wp_enqueue_scripts', 'defer_jquery', 100);

function levin_scripts()
{
    $theme_version = wp_get_theme()->get('Version');

    wp_enqueue_style('theme', get_stylesheet_uri(), [], $theme_version);

    // Vendors

    /* SwiperJS */
    wp_enqueue_script('swiper', get_template_directory_uri() . '/src/vendor/swiper-bundle.js', [], '8.0.6', true);
    // swiper CSS — через @import в style.css (первыми, до наших стилей)
    // wp_enqueue_style( 'swiper-bundle', get_template_directory_uri() . '/src/vendor/swiper-bundle.css', null, '8.0.6' );
    // wp_enqueue_style( 'swiper', get_template_directory_uri() . '/src/vendor/swiper.css', null, '4.5.1' );

    /* justifiedGallery */
    wp_enqueue_style('justifiedGallery', get_template_directory_uri() . '/src/vendor/justifiedGallery.css', null, null);

    /* glightBox */
    wp_enqueue_script('glightbox', get_template_directory_uri() . '/src/vendor/glightbox.js', [], null, true);
    wp_enqueue_style('glightbox', get_template_directory_uri() . '/src/vendor/glightbox.css', null, null);

    /* jQuery Masked Input */
    wp_enqueue_script('jquery.maskedinput', get_template_directory_uri() . '/src/vendor/jquery.maskedinput.js', ['jquery'], '1.4.1', true);

    /* Bootstrap */
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/src/vendor/bootstrap.bundle.js', ['jquery', 'jquery.maskedinput'], $theme_version, true);

    /* Core — всегда нужны */
    wp_enqueue_script('levin-utils', get_template_directory_uri() . '/static/js/utils.js', ['jquery'], $theme_version, true);
    wp_enqueue_script('levin-lead-attribution', get_template_directory_uri() . '/static/js/lead-attribution.js', [], $theme_version, true);
    wp_enqueue_script('footer-mobile', get_template_directory_uri() . '/static/js/footer-mobile.js', ['jquery', 'levin-utils'], $theme_version, true);
    wp_enqueue_script('ui-tabs-price', get_template_directory_uri() . '/static/js/ui-tabs-price.js', ['jquery', 'levin-utils'], $theme_version, true);
    wp_enqueue_script('ui-misc', get_template_directory_uri() . '/static/js/ui-misc.js', ['jquery', 'levin-utils'], $theme_version, true);
    wp_enqueue_script('legacy-swipers', get_template_directory_uri() . '/static/js/legacy-swipers.js', ['jquery', 'swiper'], $theme_version, true);

    /* Loader — динамически подгружает остальные скрипты */
    wp_enqueue_script('loader', get_template_directory_uri() . '/static/js/loader.js', [], $theme_version, true);
    wp_localize_script('loader', 'levin_loader', [
        'base' => get_template_directory_uri() . '/static/js/',
    ]);
    // promo_ajax нужна для promo-banner.js, который грузится через loader
    wp_add_inline_script(
        'loader',
        'var promo_ajax = ' .
            json_encode([
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('promo_banner_nonce'),
            ]) .
            ';',
        'before',
    );

    // Параметры приёма заявок для forms-handler.js: URL admin-ajax.php, действие и nonce.
    // Сам обработчик — inc/lead-form.php; старый адрес ajax.php больше не используется.
    wp_add_inline_script(
        'loader',
        'var levin_lead = ' .
            wp_json_encode([
                'url' => admin_url('admin-ajax.php'),
                'action' => LEVIN_LEAD_ACTION,
                'nonce' => wp_create_nonce(LEVIN_LEAD_NONCE),
            ]) .
            ';',
        'before',
    );

    // разбит на static/css/ и подключается через main.css
    // wp_enqueue_style( 'nav-styles',  get_template_directory_uri() . '/src/css/style.css' );

    // Fonts
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Rubik:300,400,500&subset=latin,cyrillic&display=block', false);

    if (is_front_page()) {
        wp_enqueue_script('aos', get_template_directory_uri() . '/src/vendor/aos.js', [], '2.3.1', true);
        wp_enqueue_style('aos-styles', get_template_directory_uri() . '/src/vendor/aos.css', null, '2.3.1');
        wp_enqueue_script('index-main', get_template_directory_uri() . '/static/js/index-main.js', ['jquery', 'aos'], null, true);
    }

    wp_enqueue_script('isotope', get_template_directory_uri() . '/src/vendor/isotope.pkgd.js', ['jquery'], null, true);
    wp_enqueue_script('isotope-custom', get_template_directory_uri() . '/static/js/isotope.js', ['jquery', 'isotope'], null, true);
}

add_action('wp_enqueue_scripts', 'levin_scripts', 1);

/**
 * Стили для классического редактора (TinyMCE): модалки Lazy Blocks и мета-поля.
 * Блочный редактор не затрагивается — там свои editor-styles.
 */
add_filter('mce_css', function ($stylesheets) {
    $url = get_template_directory_uri() . '/static/css/editor-classic.css';

    return $stylesheets ? $stylesheets . ',' . $url : $url;
});
