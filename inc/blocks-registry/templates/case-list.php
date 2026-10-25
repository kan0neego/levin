<?php
/**
 * Общая функция рендера карточки кейса.
 *
 * @package doctorlevin
 */

if ( function_exists( 'render_case_card' ) ) {
    return null;
}

/**
 * Возвращает HTML карточки кейса.
 *
 * @param int $case_id ID записи типа «cases».
 * @return string HTML карточки или пустая строка, если кейс недоступен.
 */
function render_case_card( $case_id ) {
    $case_id = absint( $case_id );

    if ( ! $case_id ) {
        return '';
    }

    $case = get_post( $case_id );

    if ( ! $case instanceof WP_Post || 'cases' !== $case->post_type || 'publish' !== $case->post_status ) {
        return '';
    }

    $backup_post     = isset( $GLOBALS['post'] ) ? $GLOBALS['post'] : null;
    $GLOBALS['post'] = $case; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

    setup_postdata( $case );

    ob_start();
    get_template_part( 'template-parts/cards/case-card-list' );
    $html = ob_get_clean();

    $GLOBALS['post'] = $backup_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

    if ( $backup_post instanceof WP_Post ) {
        setup_postdata( $backup_post );
    }

    return $html;
}
