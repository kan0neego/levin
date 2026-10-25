<?php
/**
 * Вспомогательные функции темы.
 *
 * @package levin
 */

/**
 * Фасад для wp_get_attachment_image(): принимает значение ACF-поля изображения
 * (массив вида ['ID' => ...] или ID вложения) и возвращает готовый HTML-код.
 *
 * Скрывает нормализацию поля-изображения и настройку атрибутов (lazy-loading).
 *
 * @param mixed  $image Значение ACF-поля изображения.
 * @param string $size  Размер изображения. По умолчанию 'full'.
 * @param string $alt   Alt-текст. Если пуст — используется alt вложения.
 *
 * @return string HTML изображения или пустая строка, если изображение не задано.
 */
function get_acf_image_html( $image, $size = 'full', $alt = '' ) {
    $attachment_id = is_array( $image ) ? (int) ( $image['ID'] ?? 0 ) : (int) $image;

    if ( $attachment_id <= 0 ) {
        return '';
    }

    $attributes = array( 'loading' => 'lazy' );

    if ( '' !== $alt ) {
        $attributes['alt'] = $alt;
    }

    return wp_get_attachment_image( $attachment_id, $size, false, $attributes );
}

/**
 * URL текущего запроса, собранный только из доверенного Host.
 *
 * @return string|null URL либо null, если Host не совпадает с адресом сайта.
 */
function request_url() {
    $site = wp_parse_url( home_url() );

    $site_host = strtolower( isset( $site['host'] ) ? $site['host'] : '' );
    if ( ! empty( $site['port'] ) ) {
        $site_host .= ':' . (int) $site['port'];
    }

    $req_host = isset( $_SERVER['HTTP_HOST'] ) ? strtolower( sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) ) : '';

    if ( '' === $site_host || $req_host !== $site_host ) {
        return null;
    }

    $uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

    return ( is_ssl() ? 'https' : 'http' ) . '://' . $site_host . $uri;
}

/**
 * Строка ссылки-отзыва для URL текущего запроса.
 *
 * @return object|null Запись таблицы `levin_feedback_links` либо null.
 */
function feedback_link_row() {
    static $row = false;

    if ( false !== $row ) {
        return $row;
    }

    $row = null;
    $url = request_url();

    if ( null !== $url ) {
        global $wpdb;

        $row = $wpdb->get_row(
            $wpdb->prepare( 'SELECT * FROM `levin_feedback_links` WHERE link_short = %s LIMIT 1', $url )
        );
    }

    return $row;
}
