<?php
/**
 * Общая функция рендера баннера специалиста.
 *
 * @package doctorlevin
 */

if ( function_exists( 'render_specialist_slide' ) ) {
    return null;
}

/**
 * Возвращает HTML баннера специалиста.
 *
 * @param int $doctor_id ID записи типа «doctors».
 * @return string HTML баннера или пустая строка, если врач недоступен.
 */
function render_specialist_slide( $doctor_id ) {
    $doctor_id = absint( $doctor_id );

    if ( ! $doctor_id ) {
        return '';
    }

    $doctor = get_post( $doctor_id );

    if ( ! $doctor instanceof WP_Post || 'doctors' !== $doctor->post_type || 'publish' !== $doctor->post_status ) {
        return '';
    }

    $backup_post     = isset( $GLOBALS['post'] ) ? $GLOBALS['post'] : null;
    $GLOBALS['post'] = $doctor; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

    setup_postdata( $doctor );

    ob_start();
    get_template_part( 'template-parts/sliders/specialist-slide' );
    $html = ob_get_clean();

    $GLOBALS['post'] = $backup_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

    if ( $backup_post instanceof WP_Post ) {
        setup_postdata( $backup_post );
    }

    return $html;
}
