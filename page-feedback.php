<?php
/**
 * Template Name: Страница отзывов
 */

if ( null === request_url() ) {
    status_header( 400 );
    wp_die( 'Некорректный адрес запроса.', '', array( 'response' => 400 ) );
}

if ( ! feedback_link_row() ) {
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    nocache_headers();
    get_template_part( '404' );
    exit;
}
?>

<?php get_header();?>
<?php
  get_template_part('template-parts/feedback/feedback');
?>
<?php get_footer(); ?>
