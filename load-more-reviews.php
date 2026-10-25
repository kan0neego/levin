<?php
/**
 * Кнопка «Показать ещё» для отзывов.
 *
 * Разметка (прелоадер + кнопка) остаётся здесь как частица темы; вся логика
 * «догрузки отзывов» вынесена в static/js/reviews-load-more.js
 *
 * Параметры (type, doctor_id, базовый URL) передаются в JS через
 * wp_localize_script().
 */
?>
<div class="reviews-preloader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
<div  class="reviews-load_more__button">Показать еще </div>
<?php
// Логика догрузки — static/js/reviews-load-more.js; параметры передаются в JS.
wp_enqueue_script(
    'reviews-load-more',
    get_template_directory_uri() . '/static/js/reviews-load-more.js',
    array( 'jquery' ),
    wp_get_theme()->get( 'Version' ),
    true
);
wp_localize_script(
    'reviews-load-more',
    'reviewsLoadMoreConfig',
    array(
        'type'      => isset( $args['type'] ) ? $args['type'] : 'all',
        'doctor_id' => isset( $args['doctor_id'] ) ? $args['doctor_id'] : '',
        'home_url'  => home_url(),
        'icon_url'  => get_template_directory_uri() . '/img/icon.png',
    )
);



