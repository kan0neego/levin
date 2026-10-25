<?php
/**
 * Обязательный файл темы. Все страницы сайта идут через свои шаблоны:
 * front-page.php, page.php, single*.php, archive.php, taxonomy-*.php, 404.php.
 * Если запрос всё же дошёл сюда, своего шаблона у него нет — отдаём 404.
 */

global $wp_query;
$wp_query->set_404();
status_header( 404 );
nocache_headers();

require get_404_template();